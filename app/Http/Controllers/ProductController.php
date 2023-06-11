<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

use App\Http\Requests\Products\FiltersProductsRequest;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Requests\Products\DeleteImageProductRequest;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->middleware('can:products.index')->only('index');
        $this->middleware('can:products.create')->only('create', 'store');
        $this->middleware('can:products.edit')->only('edit', 'update');
        $this->middleware('can:products.show')->only('show');
        $this->middleware('can:products.destroy')->only('destroy');
        $this->middleware('can:products.trashed')->only('trashed');
        $this->middleware('can:products.restore')->only('restore', 'restoreAll');
        $this->middleware('can:products.forceDelete')->only('forceDelete', 'forceDeleteAll');
        $this->middleware('can:products.pdf')->only('getPDF');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FiltersProductsRequest $request): View
    {
        $request->name != null ?  $old_values['values_filters']['name'] = $request->name :  $old_values['values_filters']['name'] = "";
        $request->description != null ?  $old_values['values_filters']['description'] = $request->description :  $old_values['values_filters']['description'] = "";
        $request->category != null ?  $old_values['values_filters']['category'] = $request->category :  $old_values['values_filters']['category'] = "";
        $request->subcategory != null ?  $old_values['values_filters']['subcategory'] = $request->subcategory :  $old_values['values_filters']['subcategory'] = "";
        $request->min_stock != null ?  $old_values['values_filters']['min_stock'] = $request->min_stock :  $old_values['values_filters']['min_stock'] = "";
        $request->max_stock != null ?  $old_values['values_filters']['max_stock'] = $request->max_stock :  $old_values['values_filters']['max_stock'] = "";
        $request->min_price != null ?  $old_values['values_filters']['min_price'] = $request->min_price :  $old_values['values_filters']['min_price'] = "";
        $request->max_price != null ?  $old_values['values_filters']['max_price'] = $request->max_price :  $old_values['values_filters']['max_price'] = "";
        $request->sort_in_order != null ?  $old_values['values_filters']['sort_in_order'] = $request->sort_in_order :  $old_values['values_filters']['sort_in_order'] = "";
        $request->sort_by_field != null ?  $old_values['values_filters']['sort_by_field'] = $request->sort_by_field :  $old_values['values_filters']['sort_by_field'] = "";

        $sort_fields = ['name' => 'Nombre', 'category' => 'Categoría', 'subcategory' => 'Subcategoría', 'stock' => 'Stock', 'price' => 'Precio'];

        $products = Product::with('category.subcategories')
            ->when($request->name, function ($query) use ($request){
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            })
            ->when($request->description, function ($query) use ($request){
                $query->where('description', 'LIKE', '%' . $request->description . '%');
            })
            ->when($request->category, function ($query) use ($request){
                $query->where('category_id', '=', $request->category);
            })
            ->when($request->subcategory, function ($query) use ($request){
                $query->where('subcategory_id', '=', $request->subcategory);
            })
            ->when($request->min_stock || $request->max_stock, function ($query) use ($request){
                if($request->min_stock && $request->max_stock){
                    $query->whereBetween('stock', [$request->min_stock, $request->max_stock]);
                }elseif($request->min_stock && !$request->max_stock){
                    $query->where('stock', '>' , $request->min_stock);
                }elseif(!$request->min_stock && $request->max_stock){
                    $query->where('stock', '<' , $request->max_stock);
                }
            })
            ->when($request->min_price || $request->max_price, function ($query) use ($request){
                if($request->min_price && $request->max_price){
                    $query->whereBetween('price', [$request->min_price, $request->max_price]);
                }elseif($request->min_price && !$request->max_price){
                    $query->where('price', '>' , $request->min_price);
                }elseif(!$request->min_price && $request->max_price){
                    $query->where('price', '<' , $request->max_price);
                }
            })
            ->when($request->sort_in_order && $request->sort_by_field == 'category', function ($query) use ($request){
                $query->join('categories', 'categories.id', '=', 'products.category_id')
                        ->select('products.*')
                        ->orderBy('categories.name',$request->sort_in_order);
            })
            ->when($request->sort_in_order && $request->sort_by_field == 'subcategory', function ($query) use ($request){
                $query->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
                        ->select('products.*')
                        ->orderBy('subcategories.name',$request->sort_in_order);
            })
            ->when($request->sort_in_order && in_array($request->sort_by_field, ['name', 'stock', 'price']), function ($query) use ($request){
                $query->orderBy($request->sort_by_field, $request->sort_in_order);
            })
            ->orderby('created_at', 'desc')
            ->paginate(8);

        $categories = Category::all();
        $subcategories = Subcategory::all();

        $products->appends([
            'name' => $request->name,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'min_stock' => $request->min_stock,
            'max_stock' => $request->max_stock,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'sort_in_order' => $request->sort_in_order,
            'sort_by_field' => $request->sort_by_field,
        ]);

        return view('products.index', compact('products', 'old_values', 'categories', 'subcategories', 'sort_fields'));
    }

    // static function getSubcategoriesOfCategorySelected(Category $category){
    //     $subcategoriesSelect = Subcategory::where('category_id', $category->id)->get();
    //     return with(["subcategoriesSelect" => $subcategoriesSelect]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('products.create', compact('categories','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request): RedirectResponse
    {
        try{
            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category,
                'subcategory_id' => $request->subcategory,
                'description' => $request->description,
                'stock' => $request->stock,
                'price' => $request->price,
            ]);

            if ($request->has('images_products')) {
                foreach ($request->images_products as $img) {
                    $product->addMedia($img)->toMediaCollection('prod_imgs');
                }
            }

            return redirect()->route('products.index')->with('success', 'El producto ha sido creado correctamente.');
        }catch(\Throwable $e) {
            switch ($e->getCode()) {
                case "0":
                    $msg = 'No puede subir imágenes de más de 10 MB.';
                    break;

                default:
                    $msg = 'Ha ocurrido un error al tratar de crear el producto.';
                    break;
            }
            return back()->withErrors($msg);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $images = $product->getMedia('prod_imgs');

        return view('products.show', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $images = $product->getMedia('prod_imgs');

        return view('products.edit', compact('product', 'images', 'categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        try{
            $product->update([
                'name' => $request->name,
                'category_id' => $request->category,
                'subcategory_id' => $request->subcategory,
                'description' => $request->description,
                'stock' => $request->stock,
                'price' => $request->price,
            ]);

            if ($request->has('images_products')) {
                foreach ($request->images_products as $img) {
                    $product->addMedia($img)->toMediaCollection('prod_imgs');
                }
            }

            return redirect()->route('products.show', $product->id)->with('success', 'El producto ha sido actualizado correctamente.');
        }catch(\Throwable $e) {
            switch ($e->getCode()) {
                case "0":
                    $msg = 'No puede subir imágenes de más de 10 MB.';
                    break;

                default:
                    $msg = 'Ha ocurrido un error al tratar de crear el producto.';
                    break;
            }
            return back()->withErrors($msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'El producto ha sido eliminado correctamente.');
    }

    /**
     * Display all products trashed.
     */
    public function trashed(FiltersProductsRequest $request): View
    {
        $request->name != null ?  $old_values['values_filters']['name'] = $request->name :  $old_values['values_filters']['name'] = "";
        $request->description != null ?  $old_values['values_filters']['description'] = $request->description :  $old_values['values_filters']['description'] = "";
        $request->category != null ?  $old_values['values_filters']['category'] = $request->category :  $old_values['values_filters']['category'] = "";
        $request->subcategory != null ?  $old_values['values_filters']['subcategory'] = $request->subcategory :  $old_values['values_filters']['subcategory'] = "";
        $request->min_stock != null ?  $old_values['values_filters']['min_stock'] = $request->min_stock :  $old_values['values_filters']['min_stock'] = "";
        $request->max_stock != null ?  $old_values['values_filters']['max_stock'] = $request->max_stock :  $old_values['values_filters']['max_stock'] = "";
        $request->min_price != null ?  $old_values['values_filters']['min_price'] = $request->min_price :  $old_values['values_filters']['min_price'] = "";
        $request->max_price != null ?  $old_values['values_filters']['max_price'] = $request->max_price :  $old_values['values_filters']['max_price'] = "";
        $request->sort_in_order != null ?  $old_values['values_filters']['sort_in_order'] = $request->sort_in_order :  $old_values['values_filters']['sort_in_order'] = "";
        $request->sort_by_field != null ?  $old_values['values_filters']['sort_by_field'] = $request->sort_by_field :  $old_values['values_filters']['sort_by_field'] = "";

        $sort_fields = ['name' => 'Nombre', 'category' => 'Categoría', 'subcategory' => 'Subcategoría', 'stock' => 'Stock', 'price' => 'Precio'];

        $products = Product::withTrashed()
            ->with('category.subcategories')
            ->when($request->name, function ($query) use ($request){
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            })
            ->when($request->description, function ($query) use ($request){
                $query->where('description', 'LIKE', '%' . $request->description . '%');
            })
            ->when($request->category, function ($query) use ($request){
                $query->where('category_id', '=', $request->category);
            })
            ->when($request->subcategory, function ($query) use ($request){
                $query->where('subcategory_id', '=', $request->subcategory);
            })
            ->when($request->min_stock || $request->max_stock, function ($query) use ($request){
                if($request->min_stock && $request->max_stock){
                    $query->whereBetween('stock', [$request->min_stock, $request->max_stock]);
                }elseif($request->min_stock && !$request->max_stock){
                    $query->where('stock', '>' , $request->min_stock);
                }elseif(!$request->min_stock && $request->max_stock){
                    $query->where('stock', '<' , $request->max_stock);
                }
            })
            ->when($request->min_price || $request->max_price, function ($query) use ($request){
                if($request->min_price && $request->max_price){
                    $query->whereBetween('price', [$request->min_price, $request->max_price]);
                }elseif($request->min_price && !$request->max_price){
                    $query->where('price', '>' , $request->min_price);
                }elseif(!$request->min_price && $request->max_price){
                    $query->where('price', '<' , $request->max_price);
                }
            })
            ->when($request->sort_in_order && $request->sort_by_field == 'category', function ($query) use ($request){
                $query->join('categories', 'categories.id', '=', 'products.category_id')
                        ->select('products.*')
                        ->orderBy('categories.name',$request->sort_in_order);
            })
            ->when($request->sort_in_order && $request->sort_by_field == 'subcategory', function ($query) use ($request){
                $query->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
                        ->select('products.*')
                        ->orderBy('subcategories.name',$request->sort_in_order);
            })
            ->when($request->sort_in_order && in_array($request->sort_by_field, ['name', 'stock', 'price']), function ($query) use ($request){
                $query->orderBy($request->sort_by_field, $request->sort_in_order);
            })
            ->onlyTrashed()
            ->orderby('created_at', 'desc')
            ->paginate(8);

        $categories = Category::all();
        $subcategories = Subcategory::all();

        $products->appends([
            'name' => $request->name,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'min_stock' => $request->min_stock,
            'max_stock' => $request->max_stock,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'sort_in_order' => $request->sort_in_order,
            'sort_by_field' => $request->sort_by_field,
        ]);

        return view('products.trashed', compact('products', 'old_values', 'categories', 'subcategories', 'sort_fields'));
    }

    /**
     * Restore the specified product from storage.
     */
    public function restore($id): RedirectResponse
    {
        $product = Product::onlyTrashed()->find($id);

        $product->restore();

        return back()->with('success', 'El producto ha sido restaurado correctamente.');
    }

    /**
     * Restore all products from storage.
     */
    public function restoreAll(): RedirectResponse
    {
        Product::onlyTrashed()->restore();

        return back()->with('success', 'Todos los productos han sido restaurados correctamente.');
    }


    /**
     * Force delete the specified user from storage.
     */
    public function forceDelete($id): RedirectResponse
    {
        $product = Product::onlyTrashed()->find($id);

        $product->forceDelete();

        return back()->with('success', 'El producto ha sido eliminado permanentemente.');
    }


    /**
     * Delete all products from storage.
     */
    public function forceDeleteAll(): RedirectResponse
    {
        Product::onlyTrashed()->forceDelete();

        return back()->with('success', 'Todos los productos han sido eliminados permanentemente.');
    }

    /**
     * Delete all products from storage.
     */
    public function delete_image(DeleteImageProductRequest $request): RedirectResponse
    {
        // Obtener la imagen por su ID
        $imagen = Media::findOrFail($request->img_id);

        // Eliminar la imagen de la biblioteca de medios (medialibrary)
        $imagen->delete();

        // Redirigir o devolver una respuesta según tus necesidades
        return redirect()->route('products.edit', $request->prod_id)->with('success', 'La imagen se ha eliminado correctamente.');
    }

    public function getPDF(FiltersProductsRequest $request)
    {
        $products = Product::with('category.subcategories')
            ->when($request->name, function ($query) use ($request){
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            })
            ->when($request->description, function ($query) use ($request){
                $query->where('description', 'LIKE', '%' . $request->description . '%');
            })
            ->when($request->category, function ($query) use ($request){
                $query->where('category_id', '=', $request->category);
            })
            ->when($request->subcategory, function ($query) use ($request){
                $query->where('subcategory_id', '=', $request->subcategory);
            })
            ->when($request->min_stock || $request->max_stock, function ($query) use ($request){
                if($request->min_stock && $request->max_stock){
                    $query->whereBetween('stock', [$request->min_stock, $request->max_stock]);
                }elseif($request->min_stock && !$request->max_stock){
                    $query->where('stock', '>' , $request->min_stock);
                }elseif(!$request->min_stock && $request->max_stock){
                    $query->where('stock', '<' , $request->max_stock);
                }
            })
            ->when($request->min_price || $request->max_price, function ($query) use ($request){
                if($request->min_price && $request->max_price){
                    $query->whereBetween('price', [$request->min_price, $request->max_price]);
                }elseif($request->min_price && !$request->max_price){
                    $query->where('price', '>' , $request->min_price);
                }elseif(!$request->min_price && $request->max_price){
                    $query->where('price', '<' , $request->max_price);
                }
            })
            ->when($request->sort_in_order && $request->sort_by_field == 'category', function ($query) use ($request){
                $query->join('categories', 'categories.id', '=', 'products.category_id')
                        ->select('products.*')
                        ->orderBy('categories.name',$request->sort_in_order);
            })
            ->when($request->sort_in_order && $request->sort_by_field == 'subcategory', function ($query) use ($request){
                $query->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
                        ->select('products.*')
                        ->orderBy('subcategories.name',$request->sort_in_order);
            })
            ->when($request->sort_in_order && in_array($request->sort_by_field, ['name', 'stock', 'price']), function ($query) use ($request){
                $query->orderBy($request->sort_by_field, $request->sort_in_order);
            })
            ->orderby('created_at', 'desc')
            ->get();

        // dd($products);

        $namePDF = "productos_".Carbon::now()->format('d-m-Y')."_".Carbon::now()->format('H:i:s').".pdf";

        // return view('layouts.pdfs.admin.products', compact('products'));

        $pdf = PDF::setPaper('a3')->loadView('layouts.pdfs.admin.products', compact('products'));
        return $pdf->download($namePDF);
    }

}
