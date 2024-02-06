<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tournament; // Assuming you have a Tournament model

class TournamentController extends Controller
{
    public function tournament()
    {
        // Add logic to retrieve and display tournaments
        $tournaments = Tournament::all();
        return view('admin.tournament.index', compact('tournaments'));
    }

    public function create()
    {
        return view('admin.tournament.create');
    }

    public function store(Request $request)
    {
        $tournament = new Tournament;
        $tournament->game_name = $request->input('game_name');
        $tournament->title = $request->input('title');
        $tournament->map = $request->input('map');
        $tournament->category = $request->input('category');
        $tournament->title = $request->input('title');
        $tournament->game_name = $request->input('game_name');
        $tournament->game_mode = $request->input('game_mode');
        $tournament->entry_fees = $request->input('entry_fees');
        $tournament->prize_pool = $request->input('prize_pool');
        $tournament->per_kill = $request->input('per_kill');
        $tournament->from_bonus = $request->input('from_bonus');
        $tournament->total_players = $request->input('total_players');
        $tournament->start_rank_1 = $request->input('start_rank_1');
        $tournament->start_rank_2 = $request->input('start_rank_2');
        $tournament->amount = $request->input('amount');
        $tournament->from_schedule = $request->input('from_schedule');
        $tournament->to_schedule = $request->input('to_schedule');
        $tournament->t_details = $request->input('t_details');
        $tournament->title = $request->input('title');

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/tournaments/', $filename);
            $tournament->image = $filename;
        }

        $tournament->save();
        return redirect()->route('tournament')->with('status', 'tournament Image Added Successfully');
    }

    public function edit($id)
    {
        // Retrieve the tournament by ID and pass it to the view
        $tournament = Tournament::findOrFail($id);
        return view('admin.tournament.edit', compact('tournament'));
    }

     public function update(Request $request, $id)
    {

        $tournament = Tournament::findOrFail($id);
        $tournament->game_name = $request->input('game_name');
        $tournament->title = $request->input('title');
        $tournament->map = $request->input('map');
        $tournament->category = $request->input('category');
        $tournament->title = $request->input('title');
        $tournament->game_name = $request->input('game_name');
        $tournament->game_mode = $request->input('game_mode');
        $tournament->entry_fees = $request->input('entry_fees');
        $tournament->prize_pool = $request->input('prize_pool');
        $tournament->per_kill = $request->input('per_kill');
        $tournament->from_bonus = $request->input('from_bonus');
        $tournament->total_players = $request->input('total_players');
        $tournament->start_rank_1 = $request->input('start_rank_1');
        $tournament->start_rank_2 = $request->input('start_rank_2');
        $tournament->amount = $request->input('amount');
        $tournament->from_schedule = $request->input('from_schedule');
        $tournament->to_schedule = $request->input('to_schedule');
        $tournament->t_details = $request->input('t_details');
        $tournament->title = $request->input('title');
        
        if ($request->hasfile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('public/web/images/tournaments/', $filename);
        $tournament->image = $filename;
    }
        $tournament->save();
        return redirect()->route('tournament')->with('status', 'players Image Updated Successfully');
    }


    public function delete($id)
    {
        // Delete the tournament by ID
        $tournament = Tournament::findOrFail($id);
        $tournament->delete();

        return redirect()->route('admin.tournament.index')->with('success', 'Tournament deleted successfully!');
    }
}
