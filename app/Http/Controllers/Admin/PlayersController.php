<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Players;
use App\Models\Category;
use Illuminate\Support\Str;

class PlayersController extends Controller
{
    public function players()
    {
        $players = Players::all();
        return view('admin.players.index', compact('players'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.players.create',compact('category'));
    }

    public function store(Request $request)
{
    $players = new Players;
    $players->player_name = $request->input('player_name');
    $players->player_id = Str::random(4);
    $players->category = $request->input('category');
    $selectedCategory = $request->input('category'); // Assuming $selectedCategory holds the category name

    // Retrieve the category_id based on the selected category
    $category = Category::where('category', $selectedCategory)->first();

    // Check if the category is found before assigning the category_id
    if ($category) {
        $players->category_id = $category->category_id;
    }

    if ($request->hasfile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('public/web/images/players/', $filename);
        $players->image = $filename;
    }

    $players->save();

    return redirect()->route('players')->with('status', 'Players Image Added Successfully');
}


    public function edit($id)
    {
        $players = Players::findOrFail($id);
        $category = Category::all();
        return view('admin.players.edit', compact('players','category'));
    }

    public function update(Request $request, $id)
    {
        // Validation here if needed

        $players = Players::findOrFail($id);
       $players->player_name = $request->input('player_name');
        $players->category = $request->input('category');
        $selectedCategory = $request->input('category');
        $category = Category::where('category', $selectedCategory)->first();

    if ($category) {
        $players->category_id = $category->category_id;
    }
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/players/', $filename);
            $players->image = $filename;
        }

        $players->save();
        return redirect()->route('players')->with('status', 'players Image Updated Successfully');
    }

    public function destroy($id)
    {
        $players = Players::findOrFail($id);
        $players->delete();
        return redirect()->route('players.index')->with('status', 'players Image Deleted Successfully');
    }
}
