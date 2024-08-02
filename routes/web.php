<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
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
    $products = Product::orderBy("id", "DESC")->get();
    return Inertia::render('Dashboard', compact("products"));
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
    Route::get("/product/edit/{product}", [ProductController::class, "edit"])->name("product.edit");
    Route::put("/product/update/{product}", [ProductController::class, "update"])->name("product.update");
    Route::delete("/product/delete/{product}", [ProductController::class, "destroy"])->name("product.delete");

    // cart
    Route::post("/product/add/cart", [CartController::class, "store"])->name("product.cart");
    // count cart
    Route::get("/cart/count", [CartController::class, "countCartItem"])->name("cart.count");
    Route::get("/cart", [CartController::class, "index"])->name("cart.index");
    Route::get("/cart/get/data", [CartController::class, "getIndex"])->name("cart.get.index");
    // sepetteki ürün miktarını artırma
    Route::post("/cart/increment/{cartId}", [CartController::class, "incrementQuantity"])->name("cart.increment");
    // sepetteki ürün miktarını azaltma
    Route::post("/cart/decrement/{cartId}", [CartController::class, "decrementQuantity"])->name("cart.decrement");
});

require __DIR__ . '/auth.php';
