<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/@{slug}', [HomeController::class, 'show_profile'])->name('show.profile');
Route::get('/detail/{slug}', [HomeController::class, 'show_project'])->name('show.project');

Route::prefix('/')->middleware('auth')->group(function() {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('profile', ProfileController::class);
    Route::delete('/profile/delete-avatar/{id}', [ProfileController::class, 'deleteAvatar'])->name('delete.avatar');

    Route::resource('project', ProjectController::class);
    Route::resource('budget', BudgetController::class);
    Route::get('/budget-in', [BudgetController::class, 'create_budget_in'])->name('budgetIn.create');
    Route::get('/budget-in/{id}/edit', [BudgetController::class, 'edit_budget_in'])->name('budgetIn.edit');
    Route::get('/anggaran-excel', [BudgetController::class, 'budget_excel'])->name('budget.excel');
    Route::get('/anggaran-pdf', [BudgetController::class, 'budget_pdf'])->name('budget.pdf');
});


// Admin
Route::prefix('/')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::resource('user', UserController::class);
    Route::resource('content', ContentController::class);
    Route::delete('/user/delete-avatar/{id}', [UserController::class, 'deleteAvatarUser'])->name('delete.avatar.user');

    Route::resource('category', CategoryController::class);
});
