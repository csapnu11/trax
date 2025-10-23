<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        // Redirect based on role
        return redirect('/dashboard');
    }

    // If not logged in, show landing page
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Accessible to all logged-in users
Route::middleware(['auth'])->get('/help', function () {
    return view('help');
});

// Admin-only page
Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
    return view('admin.dashboard');
});

require __DIR__.'/auth.php';
