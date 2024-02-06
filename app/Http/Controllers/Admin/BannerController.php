<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class BannerController extends Controller
{
    public function banner()
    {
        $banner = Banner::all();
        return view('admin.banner.index', compact('banner'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $banner = new Banner;
        $banner->name = $request->input('name');
        $banner->heading = $request->input('heading');
        $banner->content = $request->input('content');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/banners/', $filename);
            $banner->image = $filename;
        }
        if($request->hasfile('image1'))
        {
            $file = $request->file('image1');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/banners/', $filename);
            $banner->image1 = $filename;
        }
        if($request->hasfile('image2'))
        {
            $file = $request->file('image2');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/banners/', $filename);
            $banner->image2 = $filename;
        }
        $banner->save();
        return redirect()->back()->with('status','banner Image Added Successfully');
    }

    public function editbanner($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function updatebanner(Request $request, $id){

        $banner = Banner::findOrFail($id);
        $banner->name = $request->input('name');
        $banner->heading = $request->input('heading');
        $banner->content = $request->input('content');
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/banners/', $filename);
            $banner->image = $filename;
        }
        if($request->hasfile('image1'))
        {
            $file = $request->file('image1');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/banners/', $filename);
            $banner->image1 = $filename;
        }
        if($request->hasfile('image2'))
        {
            $file = $request->file('image2');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('public/web/images/banners/', $filename);
            $banner->image2 = $filename;
        }
        $banner->save();
        return redirect()->route('banner')->with('status','banner Image Added Successfully');
    }
    
    public function deletebanner($id)
    {
        $banner = Banner::find($id);
        $destination = 'web/images/banners/'.$banner->banner;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $banner->delete();
        return redirect()->back()->with('status','banner Image Deleted Successfully');
    }

}
