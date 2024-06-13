<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/task', [TaskController::class, 'index'])->name('task.index');
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/task/{task}/update', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/{task}/destroy', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/movies/book/{id}', [DashboardController::class, 'showBookingPage'])->name('movies.book');
    Route::post('/reserve-seat', [DashboardController::class, 'reserveSeat'])->name('reserve.seat');
    Route::get('/movies/proceed', [DashboardController::class, 'proceed'])->name('movies.proceed');
    Route::get('/ticket/print', [DashboardController::class, 'printTicket'])->name('ticket.print');

    

    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('admin/movies/create', [MovieController::class, 'create'])->name('admin.movies.create');
    Route::post('admin/movies', [MovieController::class, 'store'])->name('admin.movies.store');
    Route::get('admin/movies/{movie}/edit', [MovieController::class, 'edit'])->name('admin.movies.edit');
    Route::put('admin/movies/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');
    Route::delete('admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

require __DIR__.'/auth.php';
