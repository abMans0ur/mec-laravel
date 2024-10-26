<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all()->load('category');
        return view('ProductsTable', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('ProductCreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Product::create($data);
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return $product;
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('ProductUpdate', compact(['product', 'categories']));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();
        $product->update($data);
        return redirect()->route('product.index');

    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
