<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationsController extends Controller
{
    public function notification()
    {
        $notification = Notification::all();
        return view('admin.notification.index', compact('notification'));
    }

    public function create()
    {
        return view('admin.notification.create');
    }

    public function store(Request $request)
    {
        // Validation here if needed

        $notification = New Notification;
        $notification->title = $request->input('title');
        $notification->message = $request->input('message');
        $notification->click_action = $request->input('click_action');
        $notification->destination = $request->input('destination');
        $notification->payload = $request->input('payload');

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('web/images/notification/', $filename);
            $notification->image = $filename;
        }

        $notification->save();
        return redirect()->route('notification')->with('status', 'notification Image Updated Successfully');
    }

    public function edit()
    {
        $notification = Notification::findOrFail($id);
        return view('admin.notification.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        // Validation here if needed

        $notification = Notification::findOrFail($id);
        $notification->title = $request->input('title');
        $notification->message = $request->input('message');
        $notification->click_action = $request->input('click_action');
        $notification->destination = $request->input('destination');
        $notification->payload = $request->input('payload');

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('web/images/notification/', $filename);
            $notification->image = $filename;
        }

        $notification->save();
        return redirect()->route('notification')->with('status', 'notification Image Updated Successfully');
    }

    public function delete()
     {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return redirect()->route('notification')->with('status', 'notification Image Deleted Successfully');
    }
   
}