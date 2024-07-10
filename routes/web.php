<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameOptionsController;
use App\Http\Controllers\BuilderController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.create');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/game', [GameController::class, 'get'])->name('game');
    Route::get('/game-lists', [GameController::class, 'index'])->name('game-lists');
    Route::get('/game-lists/{gameListId}', [GameController::class, 'show'])->name('game-lists.show');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/builder', [BuilderController::class, 'index'])->name('builder');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/builder/game-options', [GameOptionsController::class, 'store'])->name('builder.game-options.create');
    Route::patch('/builder/game-options/{gametId}', [GameOptionsController::class, 'update'])->name('builder.game-options.update');
    Route::delete('/builder/game-options/{gametId}', [GameOptionsController::class, 'destroy'])->name('builder.game-options.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
