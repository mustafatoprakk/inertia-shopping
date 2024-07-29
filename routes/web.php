<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get("/categories", [CategoryController::class, "index"])->name("category.index");
    Route::post("/categories/create", [CategoryController::class, "store"])->name("category.store");
    Route::get("/categories/show/{category}", [CategoryController::class, "show"])->name("category.show");
    Route::put("/categories/update/{category}", [CategoryController::class, "update"])->name("category.update");
    Route::delete("/categories/delete/{category}", [CategoryController::class, "destroy"])->name("category.delete");

    Route::get("/product", [ProductController::class, "index"])->name("product.index");
    Route::post("/products/create", [ProductController::class, "store"])->name("product.store");
});

require __DIR__ . '/auth.php';
