<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(Request $request)
    {
        return view('admin.dashboard', [
            'user' => $request->user(),
            'welcome' => 'Welcome Admin',
        ]);
    }

    public function saler(Request $request)
    {
        return view('saler.dashboard', [
            'user' => $request->user(),
            'welcome' => 'Welcome Saler',
        ]);
    }

    public function user(Request $request)
    {
        return view('dashboard', [
            'user' => $request->user(),
            'welcome' => 'Welcome User',
        ]);
    }
}
