<?php

use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\TestController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('products')->group(function () {
    Route::get('', [ProductController::class,'index'])->name('product.index');
    Route::get('create',[ProductController::class,'create'])->name('product.create');
    Route::post('', [ProductController::class,'store'])->name('product.store');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::put('{id}', [ProductController::class,'update'])->name('product.update');
    Route::get('{id}', [ProductController::class, 'show']);
    Route::delete('{id}', [ProductController::class, 'delete'])->name('product.delete');
});

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