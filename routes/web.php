<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'km'])) {
        abort(400);
    }
    session(['locale' => $locale]);

    return redirect()->back();
});
Route::get('/dashboard', function () {
    $stats = [
        'products'        => \App\Models\Product::count(),
        'categories'      => \App\Models\Category::count(),
        'slides'          => \App\Models\Slide::count(),
        'users'           => \App\Models\User::count(),
        'low_stock'       => \App\Models\Product::where('stock', '<=', 5)->count(),
        'active_products' => \App\Models\Product::where('is_active', true)->count(),
    ];
    $recent_products = \App\Models\Product::with('category')->latest()->take(5)->get();
    return view('dashboard', compact('stats', 'recent_products'));
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
Route::resource('roles', \App\Http\Controllers\RoleController::class)->middleware('auth');
Route::resource('permissions', \App\Http\Controllers\PermissionController::class)->middleware('auth');

Route::get('/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])
    ->name('checkout');
Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])
    ->name('orders.index');
Route::get('/create', [\App\Http\Controllers\OrderController::class, 'create'])
    ->name('orders.create');
Route::get('/edit/{id}', [\App\Http\Controllers\OrderController::class, 'edit'])
    ->name('orders.edit');
Route::post('/orders/store', [\App\Http\Controllers\OrderController::class, 'store'])
    ->name('orders.store');
Route::get('purchases', [\App\Http\Controllers\PurchaseController::class, 'index'])->name('purchases.index');
require __DIR__.'/auth.php';
Route::get('/purchases/create', [\App\Http\Controllers\PurchaseController::class, 'create'])->name('purchases.create');