<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'catName'   =>  'string|required|max:255'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors());
        $data = $validator->validated();
        Category::create([
            'name' => $data['catName']
        ]);
        return redirect()->route('category.index');
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'catName'  => 'required|string|max:255'
        ]);
        if ($validator->fails())
            return response($validator->errors());
        $category = Category::find($id);
        if (!$category) {
            return response('Category not found!!!');
        }
        $data = $validator->validated();
        $category->name = $data['catName'];
        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response('Category not found!!!');
        }
        $category->delete();
        return redirect()->route('category.index');
    }
}
