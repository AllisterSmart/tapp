<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function loction()
    {
        $loction = Location::all();
        return view('admin.loction.index', compact('loction'));
    }

    public function create()
    {
        return view('admin.loction.create');
    }

    public function store(Request $request)
    {
        $loction = new Location;
        $loction->country = $request->input('country');
        $loction->state = $request->input('state');
        $loction->city = $request->input('city');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('web/images/loctions/', $filename);
            $loction->image = $filename;
        }
        $loction->save();
        return redirect()->route('loction')->with('status','loction Image Added Successfully');
    }

    public function editloction($id)
    {
        $loction = Location::find($id);
        return view('admin.loction.edit', compact('loction'));
    }

    public function updateloction(Request $request, $id){

        $loction = Location::findOrFail($id);
        $loction->country = $request->input('country');
        $loction->state = $request->input('state');
        $loction->city = $request->input('city');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('web/images/loctions/', $filename);
            $loction->image = $filename;
        }
        $loction->save();
        return redirect()->route('loction')->with('status','loction Image Added Successfully');
    }
    
    
    public function deleteloction($id)
    {
        $loction = Location::find($id);
        
        $loction->delete();
        return redirect()->back()->with('status','Loction Image Deleted Successfully');
    }
}
