<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Games;
use App\Models\Category;

class GamesController extends Controller
{
    public function games()
    {
        $games = Games::all();
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.games.create',compact('category'));
    }

    public function store(Request $request)
    {
        // Add validation here if needed

        $games = new Games;
        $games->game_name = $request->input('game_name');
        $games->category = $request->input('category');
        $selectedCategory = $request->input('category'); // Assuming $selectedCategory holds the category name

    // Retrieve the category_id based on the selected category
    $category = Category::where('category', $selectedCategory)->first();

    // Check if the category is found before assigning the category_id
    if ($category) {
        $games->category_id = $category->category_id;
    }
        $games->tutorials_link = $request->input('tutorials_link');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/games/', $filename);
            $games->image = $filename;
        }
        $games->save();
        return redirect()->route('games')->with('status', 'games Image Added Successfully');
    }

    public function edit($id)
{
    $games = Games::findOrFail($id);
    $category = Category::all();
    return view('admin.games.edit', compact('games', 'category'));
}


    public function update(Request $request, $id)
    {
        // Validation here if needed

        $games = Games::findOrFail($id);
       $games->game_name = $request->input('game_name');
        $games->category = $request->input('category');
        $selectedCategory = $request->input('category'); // Assuming $selectedCategory holds the category name

    // Retrieve the category_id based on the selected category
    $category = Category::where('category', $selectedCategory)->first();

    // Check if the category is found before assigning the category_id
    if ($category) {
        $games->category_id = $category->category_id;
    }
        $games->tutorials_link = $request->input('tutorials_link');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/games/', $filename);
            $games->image = $filename;
        }

        $games->save();
        return redirect()->route('games')->with('status', 'games Image Updated Successfully');
    }

    public function destroy($id)
    {
        $games = Games::findOrFail($id);
        $games->delete();
        return redirect()->route('games.index')->with('status', 'games Image Deleted Successfully');
    }
}
