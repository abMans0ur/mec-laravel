<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Update;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::all()->load('category');
        return response()->json(["success"=>true,"data"=>ProductResource::collection($products)]);
        // return view('ProductsTable', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('ProductCreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'             => 'required|string|max:255|unique:products,name',
            'description'      => 'required|string|max:255',
            'price'            =>'required|numeric|min:1',
            'stock'            =>'required|integer|min:1',
            'category_id'      =>'required|integer|exists:categories,id',
            'discount'         =>'nullable|numeric|max:100'
        ]);
        if ($validator->fails())
            return response($validator->errors());
        $data = $validator->validated();
        if(isset($data['discount']))
            $data['is_discount'] = true;
        Product::create($data);
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'success'=>true,
            'data'=>ProductResource::make($product)
        ]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('ProductUpdate', compact(['product', 'categories']));
    }

    public function update(Update $request, $id)
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
