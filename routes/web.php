<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameOptionsController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ListItemController;

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
    Route::get('/builder/game-options', [GameOptionsController::class, 'index'])->name('builder.game-options.index');
    Route::post('/builder/game-options', [GameOptionsController::class, 'store'])->name('builder.game-options.create');
    Route::patch('/builder/game-options/{gametId}', [GameOptionsController::class, 'update'])->name('builder.game-options.update');
    Route::delete('/builder/game-options/{gametId}', [GameOptionsController::class, 'destroy'])->name('builder.game-options.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/builder/category', [CategoryController::class, 'index'])->name('builder.category.index');
    Route::post('/builder/category', [CategoryController::class, 'store'])->name('builder.category.create');
    Route::patch('/builder/category/{id}', [CategoryController::class, 'update'])->name('builder.category.update');
    Route::delete('/builder/category/{id}', [CategoryController::class, 'destroy'])->name('builder.category.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/builder/list', [ListController::class, 'index'])->name('builder.list.index');
    Route::post('/builder/list', [ListController::class, 'store'])->name('builder.list.create');
    Route::delete('/builder/list/{id}', [ListController::class, 'destroy'])->name('builder.list.destroy');
    Route::get('/builder/list/item/{id}', [ListController::class, 'get'])->name('builder.list.get');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/builder/list/item', [ListItemController::class, 'store'])->name('builder.list.item.create');
    Route::delete('/builder/list/item/{id}', [ListItemController::class, 'destroy'])->name('builder.list.item.destroy');
    Route::get('/builder/list/item/{id}', [ListItemController::class, 'get'])->name('builder.list.item.get');
    Route::patch('/builder/list/item/{id}', [ListItemController::class, 'update'])->name('builder.list.item.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
