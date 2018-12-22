<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notificationController extends Controller
{
    public function index()
    {
        if(auth()->user()->admin){
            return view('admin.notification');
        }
        return view('rh.notification');
    }

    public function read()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return 'true';
    }

    public function destroy()
    {
        auth()->user()->notifications()->delete();
        return back();
    }
}
