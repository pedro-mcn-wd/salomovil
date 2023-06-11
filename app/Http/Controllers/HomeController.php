<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

use App\Http\Requests\HomeRequest;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $productsCarousel = Product::where('price', '>', 200)->inRandomOrder()->take(5)->get();
        $productsCards = Product::where('price', '<', 200)->inRandomOrder()->take(6)->get();
        $categories = Category::all();
        return view('home.index', compact('categories', 'productsCarousel', 'productsCards'));
    }

    /**
     * Display the specified resource.
     */
    public function showCategoryOrSubcategory(HomeRequest $request): View
    {
        if($request->has('category')){
            $products = Product::where('category_id', $request->category)->get();
            $is = 'category';
            $section = Category::find($request->category);
        }else{
            $products = Product::where('subcategory_id', $request->subcategory)->get();
            $is = 'subcategory';
            $section = Subcategory::find($request->subcategory);
        }
        $categories = Category::all();

        return view('home.showCategoryOrSubcategory', compact('categories','products', 'is', 'section'));
    }

    /**
     * Display the specified resource.
     */
    public function showProduct(Product $product, HomeRequest $request): View
    {
        $images = $product->getMedia('prod_imgs');
        $origin = array();
        $origin['origin'] = $request->origin;
        if($request->origin === "fromShowCat"){
            $origin['is'] = $request->is;
            $origin['id'] = $request->id;
        }

        $categories = Category::all();
        return view('home.showProduct', compact('product', 'images', 'origin', 'categories'));
    }
}
