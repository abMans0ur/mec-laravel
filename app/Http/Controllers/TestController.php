<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $title = env('APP_NAME');
        $products = Product::all()->load('category');
        return response()->json([
            'tittle' =>$title,
            'success' => true,
            'data' => $products
        ], 200);
    }
}
