<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Tournaments;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Games;
use App\Models\Category;
use App\Models\Players;

class TournamentsController extends Controller
{
    public function Tournaments()
    {
        $Tournaments = Tournaments::all();
        return view('admin.tournaments.index', compact('Tournaments'));
    }

    public function create()
    {
        $games = Games::all();
        $category = Category::all();
        $players = Players::all();
        return view('admin.tournaments.create',compact('games','category','players'));
    }

    public function store(Request $request)
    {
        $Tournaments = new Tournaments;
        $Tournaments->game_name = $request->input('game_name');
        $Tournaments->title = $request->input('title');
        $Tournaments->map = $request->input('map');
        $Tournaments->category = $request->input('category');
        $Tournaments->game_type = $request->input('game_type');
        
        $players = implode(',', $request->input('players'));
        $Tournaments->players = $players;
        
        $Tournaments->game_name = $request->input('game_name');
        $Tournaments->game_mode = $request->input('game_mode');
        
        $amount = implode(',', $request->input('entry_fees'));
        $Tournaments->players = $amount;
        
        $Tournaments->prize_pool = $request->input('prize_pool');
        $Tournaments->per_kill = $request->input('per_kill');
        $Tournaments->from_bonus = $request->input('from_bonus');
        $Tournaments->total_players = $request->input('total_players');
        $Tournaments->start_rank_1 = $request->input('start_rank_1');
        $Tournaments->start_rank_2 = $request->input('start_rank_2');
        $Tournaments->amount = $request->input('amount');
        $Tournaments->from_schedule = $request->input('from_schedule');
        $Tournaments->to_schedule = $request->input('to_schedule');
        $Tournaments->t_details = $request->input('t_details');
        $Tournaments->title = $request->input('title');
        $selectedCategory = $request->input('category'); // Assuming $selectedCategory holds the category name

    // Retrieve the category_id based on the selected category
    $category = Category::where('category', $selectedCategory)->first();

    // Check if the category is found before assigning the category_id
    if ($category) {
        $Tournaments->category_id = $category->category_id;
    }
        
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/tournaments/', $filename);
            $Tournaments->image = $filename;
        }
        $Tournaments->save();
        return redirect()->back()->with('status','Tournaments Image Added Successfully');
    }

    public function edit($id)
    {
        $Tournaments = Tournaments::find($id);
        $games = Games::all();
        $category = Category::all();
         $players = Players::all();
        return view('admin.tournaments.edit', compact('Tournaments','games','category','players'));
    }

    public function update(Request $request, $id){
        
        $Tournaments = Tournaments::findOrFail($id);
        $Tournaments->game_name = $request->input('game_name');
        $Tournaments->title = $request->input('title');
        $Tournaments->map = $request->input('map');
        $Tournaments->category = $request->input('category');
        $Tournaments->game_type = $request->input('game_type');

        $players = implode(',', $request->input('players'));
        $Tournaments->players = $players;
        
        $Tournaments->game_name = $request->input('game_name');
        $Tournaments->game_mode = $request->input('game_mode');
        
        $amount = implode(',', $request->input('entry_fees'));
        $Tournaments->entry_fees = $amount;
        
        $Tournaments->prize_pool = $request->input('prize_pool');
        $Tournaments->per_kill = $request->input('per_kill');
        $Tournaments->from_bonus = $request->input('from_bonus');
        $Tournaments->total_players = $request->input('total_players');
        $Tournaments->start_rank_1 = $request->input('start_rank_1');
        $Tournaments->start_rank_2 = $request->input('start_rank_2');
        $Tournaments->amount = $request->input('amount');
        $Tournaments->from_schedule = $request->input('from_schedule');
        $Tournaments->to_schedule = $request->input('to_schedule');
        $Tournaments->t_details = $request->input('t_details');
        $Tournaments->title = $request->input('title');
        
       $selectedCategory = $request->input('category'); // Assuming $selectedCategory holds the category name

    // Retrieve the category_id based on the selected category
    $category = Category::where('category', $selectedCategory)->first();

    // Check if the category is found before assigning the category_id
    if ($category) {
        $Tournaments->category_id = $category->category_id;
    }
    
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/tournaments/', $filename);
            $Tournaments->image = $filename;
        }
        $Tournaments->save();
        return redirect()->route('tournaments')->with('status','Tournaments Image Added Successfully');
    }
    
    public function delete($id)
    {
        $Tournaments = Tournaments::find($id);
        $destination = 'web/images/tournaments/'.$Tournaments->Tournaments;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $Tournaments->delete();
        return redirect()->back()->with('status','Tournaments Image Deleted Successfully');
    }

}
