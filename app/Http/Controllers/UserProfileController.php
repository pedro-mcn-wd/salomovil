<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserProfile;
use App\Models\Shoppingcart;

use Illuminate\Http\Request;
use App\Http\Requests\UserProfiles\UpdateUserProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('can:profiles.edit')->only('edit', 'update');
        $this->middleware('can:profiles.show')->only('show');
        $this->middleware('can:profiles.seeShoppings')->only('seeShoppings');
        $this->middleware('can:profiles.invoice')->only('getInvoice');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $profile): View
    {
        $birthdate = Carbon::parse($profile->birthdate)->format('d/m/Y');

        return view('profile.show', compact('profile', 'birthdate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $profile): View
    {
        if ($profile->birthdate != null)
            $birthdate = Carbon::parse($profile->birthdate)->format('Y-m-d');
        else
            $birthdate = null;

        return view('profile.edit', compact('profile', 'birthdate'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request, UserProfile $profile): RedirectResponse
    {
        $user = $profile->user;

        if ($request->has('avatar')) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('users_avatar');
        }

        $user->update([
            'email' => $request->email,
        ]);

        if ($request->password != null) {
            $request->validate([
                'actual_password' => 'required',
                'password' => 'confirmed|min:8',
            ]);

            $hashedPassword = $user->getAuthPassword();

            if (Hash::check($request->actual_password, $hashedPassword)) {

                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            } else {
                return back()->with('actual_password_error', 'La contraseña actual introducida no coincide con la del usuario.');
            }
        }

        $profile->update([
            'name' => $request->name,
            'surname_first' => $request->surname_first,
            'surname_second' => $request->surname_second,
            'birthdate' => $request->birthdate,
            'bio' => $request->bio,
        ]);

        return redirect()->route('profiles.show', $profile->id)->with('success', 'Los datos han sido actualizados correctamente.');
    }

    //ver mis compras
    public function seeShoppings(): View
    {
        $shoppingcarts = Shoppingcart::where('identifier', Auth::id())->get();

        $carts = array();
        $cont = 0;
        foreach ($shoppingcarts as $oneCart){
            $carts[$cont]['id'] = $oneCart->id;
            $carts[$cont]['user_id'] = $oneCart->identifier;

            $order = Order::where('shoppingcart_id', $oneCart->id)->get()->first();
            $carts[$cont]['delivery_address'] = $order->delivery_address;

            $carts[$cont]['created_at'] = Carbon::parse($oneCart->created_at)->format('d/m/Y');

            $total = 0;
            foreach (json_decode($oneCart->content) as $item) {
                $carts[$cont]['items'][$item->name]['rowId'] = $item->rowId;
                $carts[$cont]['items'][$item->name]['qty'] = $item->qty;
                $carts[$cont]['items'][$item->name]['price'] = $item->price;
                $carts[$cont]['items'][$item->name]['name'] = $item->name;
                $carts[$cont]['items'][$item->name]['url_img'] = $item->url_img;
                $carts[$cont]['items'][$item->name]['product_id'] = $item->product_id;

                $total = $total + ($item->qty * $item->price);
            }
            $carts[$cont]['total'] = $total;
            $cont = $cont + 1;
        }

        // dd($carts);

        return view('profile.my_shoppings', compact('carts'));
    }

    public function getInvoice(Shoppingcart $shoppingcart)
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
        foreach (unserialize($shoppingcart->content) as $item) {
            $cart['items'][$item->name]['rowId'] = $item->rowId;
            $cart['items'][$item->name]['qty'] = $item->qty;
            $cart['items'][$item->name]['price'] = $item->price;
            $cart['items'][$item->name]['name'] = $item->name;
            $cart['items'][$item->name]['url_img'] = $item->options->url_img;
            $cart['items'][$item->name]['product_id'] = $item->options->product_id;

            $total = $total + ($item->qty * $item->price);
        }
        $cart['total'] = $total;

        $namePDF = 'factura_' . $cart['id'] . '_' . $cart['user_id'] . '.pdf';

        $pdf = PDF::loadView('layouts.pdfs.user.invoice', compact('cart'));
        return $pdf->download($namePDF);
    }
}
