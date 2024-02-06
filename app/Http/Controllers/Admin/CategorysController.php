<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;


class CategorysController extends Controller
{
    public function Category()
    {
        $category = Category::all();
        return view('admin.categorys.index', compact('category'));
    }

    public function create()
    {
        return view('admin.categorys.create');
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->category = $request->input('category');
        $category->category_id = Str::random(4);
        $category->save();
        return redirect()->route('category')->with('status', 'Category Image Added Successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categorys.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validation here if needed

        $category = Category::findOrFail($id);
        $category->category = $request->input('category');

        $category->save();
        return redirect()->route('category')->with('status', 'Category Image Updated Successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('status', 'Category Image Deleted Successfully');
    }
}
