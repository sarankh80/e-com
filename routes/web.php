<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front');
});
Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'km'])) {
        abort(400);
    }
    session(['locale' => $locale]);

    return redirect()->back();
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('products', \App\Http\Controllers\ProductController::class)->middleware('auth');
Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware('auth');
Route::resource('slides', \App\Http\Controllers\SlideController::class)->middleware('auth');
Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('roles', \App\Http\Controllers\GroupController::class)->middleware('auth');
Route::resource('permissions', \App\Http\Controllers\PermissionController::class)->middleware('auth');

require __DIR__.'/auth.php';
