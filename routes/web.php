<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public home page
Route::get('/', function () {
    return view('welcome');
});

// After login/registration → redirect to /go (role-based redirect)
Route::middleware(['auth'])->get('/go', function () {
    // ✅ Only run once per login
    if (!session()->pull('redirect_after_login')) {
        return redirect()->route('dashboard'); // fallback if no session flag
    }

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    } elseif ($user->role === 'saler') {
        return redirect()->route('dashboard.saler');
    } else {
        return redirect()->route('dashboard');
    }
})->name('role.redirect');

// Role-based dashboards (only for authenticated users)
Route::middleware(['auth'])->group(function () {
    // Default User Dashboard
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');

    // Dedicated dashboards
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/saler/dashboard', [DashboardController::class, 'saler'])->name('dashboard.saler');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, logout)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Auth routes from Breeze/Jetstream
require __DIR__.'/auth.php';
