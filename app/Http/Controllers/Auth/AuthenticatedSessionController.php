<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit; 
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login'); // ✅ make sure you have resources/views/auth/login.blade.php
    }

   public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();
         // Insert audit record
            DB::table('audits')->insert([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'user_role' => Auth::user()->role,
                'session_id' => session()->getId(),
                'login_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        // ✅ Flash login success message (only for next request)
        session()->flash('status', "Welcome back, {$user->name}!");

        // ✅ Store flag for /go redirection
        session(['redirect_after_login' => true]);

        // ✅ Always send user to /go
        return redirect()->route('role.redirect');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}

    public function destroy(Request $request)
    
        {
    $user = Auth::user();

    if ($user) {
        Audit::where('user_id', $user->id)
            ->where('session_id', session()->getId())
            ->whereNull('logout_at')
            ->latest()
            ->first()?->update([
                'logout_at' => now(),
            ]);
    }
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Unified logout message
        return redirect('/')->with('status', 'You are successfully logged out!');
    }
}
