<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/')->middleware('auth')->group(function() {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('profile', ProfileController::class);
    Route::delete('/profile/delete-avatar/{id}', [ProfileController::class, 'deleteAvatar'])->name('delete.avatar');
});


// Admin
Route::prefix('/')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::resource('user', UserController::class);
    Route::delete('/user/delete-avatar/{id}', [UserController::class, 'deleteAvatarUser'])->name('delete.avatar.user');
});
