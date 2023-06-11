<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddCartRequest;
use App\Http\Requests\Cart\UpdateQtyCartRequest;
use App\Http\Requests\Cart\RemoveItemCartRequest;
use App\Http\Requests\Cart\StoreCartRequest;
use App\Http\Requests\Cart\FilterDateSalesRequest;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shoppingcart;
use App\Models\Order;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

use Gloudemans\Shoppingcart\Facades\Cart;
use Barryvdh\DomPDF\Facade\Pdf;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->middleware('can:cart.add')->only('add');
        $this->middleware('can:cart.showCart')->only('showCart');
        $this->middleware('can:cart.updateItem')->only('updateQty');
        $this->middleware('can:cart.removeItem')->only('removeItem');
        $this->middleware('can:cart.clear')->only('clear');
        $this->middleware('can:cart.payCart')->only('payCart');
        $this->middleware('can:cart.storeCart')->only('storeCart');
        $this->middleware('can:cart.sales')->only('sales');
        $this->middleware('can:cart.showSale')->only('show_sale');
        $this->middleware('can:cart.invoices')->only('getInvoices');

    }

    public function add(AddCartRequest $request): RedirectResponse
    {
        if (User::find(Auth::id())->getRoleNames()[0] === "admin"){
            return back()->withErrors('Solo los clientes pueden realizar compras.');
        }

        if(intval($request->quantity) <= 0){
            return back()->withErrors('La cantidad debe ser al menos 1.');
        }

        $product = Product::find($request->product_id);

        //identifier, name, quantity and price
        Cart::add('identifier', $product->name, $request->quantity, $product->price, [
            'product_id' => $product->id,
            'url_img' => explode(URL::to(''),$product->getFirstMediaUrl('prod_imgs', 'gallery'))[1],
        ]);

        return back()->with('success', 'Producto añadido a la cesta.');
    }

    public function updateQty(UpdateQtyCartRequest $request): RedirectResponse
    {
        $item = Cart::get($request->rowId);
        $product = Product::find($item->options->product_id);

        if($request->operation === 'rest'){
            if($item->qty > 1){
                $qty = $item->qty - 1;
            }else{
                return back()->withErrors('La cantidad del producto no puede ser cero.');
            }
        }else{
            if($item->qty <= $product->stock){
                $qty = $item->qty + 1;
            }else{
                return back()->withErrors('La cantidad no puede superar al stock del producto.');
            }
        }

        Cart::update($request->rowId, $qty);

        return back()->with('success', 'Producto actualizado en la cesta.');
    }

    public function showCart(): View
    {
        $cart = Cart::content();
        $categories = Category::all();

        return view('cart.show', compact('cart', 'categories'));
    }

    public function removeItem(RemoveItemCartRequest $request)
    {
        Cart::remove($request->rowId);

        return back()->with('success', 'Producto eliminado de la cesta.');
    }

    public function clear(): RedirectResponse
    {
        Cart::destroy();

        return back()->with('success', 'Cesta vaciada.');
    }

    public function payCart(): View
    {
        if(!Auth::check()){
            Session::put('buyer',1);
            return redirect()->route('login');
        }

        if (session()->has('cart') && isset(session('cart')['default'])) {
            $cart = session('cart');

            foreach ($cart['default'] as $item) {
                $item->id = Auth::id(); // Asigna un nuevo valor al atributo 'id'
            }

            session(['cart' => $cart]); // Actualiza la sesión con la variable modificada
        }

        $today = Carbon::now();

        return view('cart.payment', compact('today'));
    }

    public function storeCart(StoreCartRequest $request): RedirectResponse
    {
        try{
            if($request->cc_expiry_date <= Carbon::now()){
                return back()->withErrors('La tarjeta de crédito introducida está caducada.');
            }

            DB::beginTransaction();

            $items = session()->get('cart.default');
            $cartSession = array();
            $cont = 0;
            foreach ($items as $value) {
                $cartSession[$cont]['rowId'] = $value->rowId;
                $cartSession[$cont]['qty'] = $value->qty;
                $cartSession[$cont]['name'] = $value->name;
                $cartSession[$cont]['price'] = $value->price;
                $cartSession[$cont]['url_img'] = $value->options->url_img;
                $cartSession[$cont]['product_id'] = $value->options->product_id;
                $cont = $cont + 1;
            }

            $cartSessionJSON = json_encode($cartSession);

            DB::table('shoppingcart')->insert([
                'identifier' => Auth::id(),
                'instance' => 'default',
                'content' => $cartSessionJSON,
                'created_at'=> new \DateTime()
            ]);

            $cart = DB::table('shoppingcart')->latest('id')->first();
            $cartId = $cart->id;

            DB::table('orders')->insert([
                'user_id' => Auth::id(),
                'shoppingcart_id' => $cartId,
                'delivery_address' => $request->delivery_address,
                'billing_address' => $request->billing_address,
                'credit_card_number' => $request->cc_number,
                'created_at' => Carbon::now()
            ]);

            DB::commit();

            Cart::destroy();

            return redirect()->route('profiles.seeShoppings')->with('success', 'Compra realizada');
        }catch (\Exception $e) {
            DB::rollback();

            return back()->withErrors('Ha habido un problema y su compra no se ha podido completar');
        }

    }

    public function sales(FilterDateSalesRequest $request): View
    {
        $request->date_from != null ?  $old_values['values_filters']['date_from'] = $request->date_from :  $old_values['values_filters']['date_from'] = "";
        $request->date_to != null ?  $old_values['values_filters']['date_to'] = $request->date_to :  $old_values['values_filters']['date_to'] = "";

        $sales = Order::when($request->date_from || $request->date_to, function ($query) use ($request) {
                        $date_from = new Carbon($request->date_from);

                        $date_to = new Carbon($request->date_to);
                        $date_to = $request->date_to ? $date_to->addDay() : Carbon::now()->endOfDay()->addDay();

                        if(($request->date_from && $request->date_to) || ($request->date_from && !$request->date_to))
                            return $query->whereBetween('created_at', [$date_from, $date_to]);
                        elseif(!$request->date_from && $request->date_to)
                            return $query->where('created_at', '<', $date_to);
                    })
                    ->paginate(8);

        $today = Carbon::now();

        $sales->appends([
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
        ]);

        return view('cart.admin.sales', compact('sales', 'today', 'old_values'));
    }

    public function show_sale(Shoppingcart $shoppingcart): View
    {
        $cart = array();
        $cart['id'] = $shoppingcart->id;
        $cart['user_id'] = $shoppingcart->identifier;
        $cart['created_at'] = Carbon::parse($shoppingcart->created_at)->format('d/m/Y');

        $order = Order::where('shoppingcart_id', $shoppingcart->id)->get()->first();
        $cart['delivery_address'] = $order->delivery_address;
        $cart['username'] = $order->user->userProfile->name.' '.$order->user->userProfile->surname_first.' '.$order->user->userProfile->surname_second;
        $cart['email'] = $order->user->email;

        $total = 0;
        foreach (json_decode($shoppingcart->content) as $item) {
            $cart['items'][$item->name]['rowId'] = $item->rowId;
            $cart['items'][$item->name]['qty'] = $item->qty;
            $cart['items'][$item->name]['price'] = $item->price;
            $cart['items'][$item->name]['name'] = $item->name;
            $cart['items'][$item->name]['url_img'] = $item->url_img;
            $cart['items'][$item->name]['product_id'] = $item->product_id;

            $total = $total + ($item->qty * $item->price);
        }
        $cart['total'] = $total;

        return view('cart.admin.show_sale', compact('cart'));
    }

    public function getInvoices(FilterDateSalesRequest $request)
    {
        $request->date_from != null ?  $old_values['values_filters']['date_from'] = $request->date_from :  $old_values['values_filters']['date_from'] = "";
        $request->date_to != null ?  $old_values['values_filters']['date_to'] = $request->date_to :  $old_values['values_filters']['date_to'] = "";

        $sales = Order::when($request->date_from || $request->date_to, function ($query) use ($request) {
                        $date_from = new Carbon($request->date_from);

                        $date_to = new Carbon($request->date_to);
                        $date_to = $request->date_to ? $date_to->addDay() : Carbon::now()->endOfDay()->addDay();

                        if(($request->date_from && $request->date_to) || ($request->date_from && !$request->date_to))
                            return $query->whereBetween('created_at', [$date_from, $date_to]);
                        elseif(!$request->date_from && $request->date_to)
                            return $query->where('created_at', '<', $date_to);
                    })
                    ->get();

        $carts = array();
        foreach ($sales as $sale) {
            $index = $sale->id;
            // $carts[$index]['id'] = $sale->shoppingcart->id;
            // $carts[$index]['user_id'] = $sale->shoppingcart->identifier;
            $total = 0;
            foreach (json_decode($sale->shoppingcart->content) as $item) {
                $carts[$index]['items'][$item->name]['rowId'] = $item->rowId;
                $carts[$index]['items'][$item->name]['qty'] = $item->qty;
                $carts[$index]['items'][$item->name]['price'] = $item->price;
                $carts[$index]['items'][$item->name]['name'] = $item->name;
                $carts[$index]['items'][$item->name]['url_img'] = $item->url_img;
                $carts[$index]['items'][$item->name]['product_id'] = $item->product_id;

                $total = $total + ($item->qty * $item->price);
            }
            $carts[$index]['total'] = $total;
        }

        // dd($carts);

        // return view('layouts.invoices.admin.invoices', compact('sales', 'carts'));

        $namePDF = "ventas_".Carbon::now()->format('d-m-Y')."_".Carbon::now()->format('H:i:s').".pdf";

        $pdf = PDF::loadView('layouts.pdfs.admin.invoices', compact('sales', 'carts'));
        return $pdf->download($namePDF);
    }
}
