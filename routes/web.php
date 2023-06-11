<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

/* home */
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/about_us', function(){
    return view('home.about_us');
})->name('home.about_us');
Route::get('/contact', function(){
    return view('home.contact');
})->name('home.contact');

Route::get('/catalog', [HomeController::class,'showCategoryOrSubcategory'])->name('home.showCategoryOrSubcategory');
Route::get('/catalog/{product}', [HomeController::class,'showProduct'])->name('home.showProduct');


/* users */
Route::resource('users', UserController::class);
Route::get('/users_trashed', [UserController::class,'trashed'])->name('users.trashed');
Route::get('/users_trashed/{id}', [UserController::class,'restore'])->name('users.restore');
Route::delete('/users_trashed/{id}/forceDelete', [UserController::class,'forceDelete'])->name('users.forceDelete');
Route::get('/users_trashed_restoreAll', [UserController::class,'restoreAll'])->name('users.restoreAll');
Route::delete('/users_trashed_deleteAll', [UserController::class,'forceDeleteAll'])->name('users.forceDeleteAll');
Route::get('/users_pdf', [UserController::class,'getPDF'])->name('users.pdf');

/* categories */
Route::resource('categories', CategoryController::class);
Route::get('/categories_trashed', [CategoryController::class,'trashed'])->name('categories.trashed');
Route::get('/categories_trashed/{id}', [CategoryController::class,'restore'])->name('categories.restore');
Route::delete('/categories_trashed/{id}/forceDelete', [CategoryController::class,'forceDelete'])->name('categories.forceDelete');
Route::get('/categories_trashed_restoreAll', [CategoryController::class,'restoreAll'])->name('categories.restoreAll');
Route::delete('/categories_trashed_deleteAll', [CategoryController::class,'forceDeleteAll'])->name('categories.forceDeleteAll');

/* products */
Route::resource('products', ProductController::class);
Route::get('/products_trashed', [ProductController::class,'trashed'])->name('products.trashed');
Route::get('/products_trashed/{id}', [ProductController::class,'restore'])->name('products.restore');
Route::delete('/products_trashed/{id}/forceDelete', [ProductController::class,'forceDelete'])->name('products.forceDelete');
Route::get('/products_trashed_restoreAll', [ProductController::class,'restoreAll'])->name('products.restoreAll');
Route::delete('/products_trashed_deleteAll', [ProductController::class,'forceDeleteAll'])->name('products.forceDeleteAll');
Route::get('/products_delete_image', [ProductController::class, 'delete_image'])->name('products.deleteImage');
Route::get('/products_pdf', [ProductController::class,'getPDF'])->name('products.pdf');

/* subcategories */
Route::resource('subcategories', SubcategoryController::class)->except('index','show');

/* user profiles */
Route::resource('profiles', UserProfileController::class)->only('show','edit','update');
Route::get('see-shoppings', [UserProfileController::class,'seeShoppings'])->name('profiles.seeShoppings');
Route::get('/invoice/{shoppingcart}', [UserProfileController::class,'getInvoice'])->name('profiles.invoice');

/* shopping cart */
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class,'add'])->name('cart.add');
    Route::get('/show-cart', [CartController::class,'showCart'])->name('cart.showCart');
    Route::put('/update-item', [CartController::class,'updateQty'])->name('cart.updateItem');
    Route::post('/remove-item', [CartController::class,'removeItem'])->name('cart.removeItem');
    Route::get('/clear', [CartController::class,'clear'])->name('cart.clear');
    Route::get('/pay-cart', [CartController::class,'payCart'])->name('cart.payCart');
    Route::post('/store-cart', [CartController::class,'storeCart'])->name('cart.storeCart');
    Route::get('/sales', [CartController::class,'sales'])->name('cart.sales');
    Route::get('/show-sale/{shoppingcart}', [CartController::class,'show_sale'])->name('cart.showSale');
    Route::get('/get-invoices', [CartController::class,'getInvoices'])->name('cart.invoices');
});



require __DIR__.'/auth.php';
