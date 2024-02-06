<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{ 
   public function team(){
       $teams = Team::all();
       return view('admin.team.index',compact('teams'));
   }
   
   public function create(){
       
       return view('admin.team.create');
   }
   
   public function store(Request $request){
       $teams = new Team;
       $teams->name = $request->input('name');
       $teams->contact = $request->input('contact');
       $teams->about = $request->input('about');
       $teams->address = $request->input('address');
       $teams->game_play = $request->input('game_play');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/team/', $filename);
            $teams->image = $filename;
        }
        $teams->save();
        return redirect()->back()->with('status','sitelogo Image Added Successfully');
    }
   
   public function edit($id){
       $teams = Team::find($id);
       return view('admin.team.edit',compact('teams'));
   }
   
   public function update(Request $request, $id){
       $teams = Team::findOrFail($id);
       $teams->name = $request->input('name');
       $teams->contact = $request->input('contact');
       $teams->about = $request->input('about');
       $teams->address = $request->input('address');
       $teams->game_play = $request->input('game_play');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/team/', $filename);
            $teams->image = $filename;
        }
        $teams->save();
        return redirect()->back()->with('status','Team Image Added Successfully');
    }
       
   
   public function delete($id)
    {
        $teams = Tean::find($id);
        $teams->delete();
        return redirect()->back()->with('status','Team Deleted Successfully');
    }

}
