<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role) {   // make sure column name is 'role'
                case 'admin':
                    return view('admin.dashboard');   // resources/views/admin/dashboard.blade.php
                case 'saler':
                    return view('saler.dashboard');   // resources/views/saler/dashboard.blade.php
                default:
                    return view('dashboard');         // resources/views/dashboard.blade.php
            }
        }

        return redirect()->route('login');
    }
}
