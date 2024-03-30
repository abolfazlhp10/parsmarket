<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\SlidersController;
use App\Http\Controllers\admin\TagsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PostersController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\BascketsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\OrdersController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/product/{slug}', [IndexController::class, 'product'])->name('product');

Route::get('/category/{category}', [IndexController::class, 'showCatProducts'])->name('category');

Route::get('/cart', [IndexController::class, 'cart'])->name('cart');
Route::post('/cart/{proid}', [BascketsController::class, 'store'])->name('cart.store');

// shopping cart routes
// Route::post('add-to-cart',[CartsController::class,'store'])->name('carts.store');
Route::post('update-cart',[CartsController::class,'updateCart'])->name('carts.update');
Route::delete('remove-cart/{id}',[CartsController::class,'removeCart'])->name('carts.remove');
Route::delete('removeAllCarts',[CartsController::class,'removeAllCarts'])->name('carts.removeAllCarts');


Route::get('google', [GoogleController::class, 'next']);
Route::get('callback-google', [GoogleController::class, 'Callback']);

//search Route
Route::get('/search',[IndexController::class,'search'])->name('search');

//comment Route
Route::post('/comment',[CommentsController::class,'store'])->name('comment');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/category', [CategoriesController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoriesController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoriesController::class, 'store'])->name('category.store');
    Route::get("category/{id}", [CategoriesController::class, 'edit'])->name('category.edit');
    Route::put("category/{id}", [CategoriesController::class, 'update'])->name('category.update');
    Route::delete("category/{id}", [CategoriesController::class, 'destroy'])->name('category.destroy');

    Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
    Route::get('/tags/{id}/edit', [TagsController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{id}/', [TagsController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');

    Route::get('/sliders', [SlidersController::class, 'index'])->name('sliders.index');
    Route::get('/sliders/create', [SlidersController::class, 'create'])->name('sliders.create');
    Route::post('/sliders', [SlidersController::class, 'store'])->name('sliders.store');
    Route::get('/sliders/{id}/edit', [SlidersController::class, 'edit'])->name('sliders.edit');
    Route::put('/sliders/{id}', [SlidersController::class, 'update'])->name('sliders.update');
    Route::delete('/sliders/{id}', [SlidersController::class, 'destroy'])->name('sliders.destroy');

    Route::get('/posters', [PostersController::class, 'index'])->name('posters.index');
    Route::get('/posters/create', [PostersController::class, 'create'])->name('posters.create');
    Route::post('/posters', [PostersController::class, 'store'])->name('posters.store');
    Route::get('/posters/{id}/edit', [PostersController::class, 'edit'])->name('posters.edit');
    Route::put('/posters/{id}', [PostersController::class, 'update'])->name('posters.update');
    Route::delete('/posters/{id}', [PostersController::class, 'destroy'])->name('posters.destroy');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('products/', [ProductsController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('products/', [ProductsController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

    Route::get('/comments',[CommentsController::class,'index'])->name('comments.index');
    Route::get('/comments/changeStatus/{commentID}',[CommentsController::class,'changeStatus'])->name('changeStatus');
    Route::get('comments/{id}/edit',[CommentsController::class,'edit'])->name('comments.edit');
    Route::put('comments/{id}',[CommentsController::class,'update'])->name('comments.update');
    Route::delete('comments/{id}',[CommentsController::class,'destroy'])->name('comments.destroy');
    Route::post('comments/{id}/sendReply',[CommentsController::class,'sendReply'])->name('sendReply');

    Route::get('/orders',[OrdersController::class,'index'])->name('orders.index');
    
    Route::delete('/orders/{id}',[OrdersController::class,'destroy'])->name('orders.destroy');
});


Route::post('request',[CartsController::class,'request'])->name('pay.request');
Route::get('verify',[CartsController::class,'verify'])->name('pay.verify');
