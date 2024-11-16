<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

        Route::prefix('products')->group(function () {
            Route::get('', [ProductController::class, 'index'])->name('product.index');
            Route::get('create', [ProductController::class, 'create'])->middleware(isAdmin::class)->name('product.create');
            Route::post('', [ProductController::class, 'store'])->name('product.store');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::put('{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('{id}', [ProductController::class, 'show']);
            Route::delete('{id}', [ProductController::class, 'delete'])->name('product.delete');
        });
        Route::prefix('category')->group(function () {
            Route::get('', [CategoryController::class, 'index'])->name('category.index');
            Route::get('create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('', [CategoryController::class, 'store'])->name('category.store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::put('{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('{id}', [CategoryController::class, 'show']);
            Route::delete('{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        });


        Route::prefix('user')->group(function () {
            Route::get('/',        [UserController::class, 'index'])->name('user.index');
            Route::get('/create',  [UserController::class, 'create'])->name('user.create');
            Route::post('/',       [UserController::class, 'store'])->name('user.store');
            Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });
    });

Route::get('login', [UserController::class, 'loginForm'])->name('user.loginForm');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
// Route::get('/products', [TestController::class,'index']);

// Route::prefix('products')->group(function () {
//     Route::get('only', function () {
//             $products = Product::all()->load('category');
//             return response()->json([
//                 'success' => true,
//                 'data' => $products
//             ], 200);
//     });
// });
