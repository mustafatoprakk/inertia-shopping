<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::with("product")
            ->where("user_id", Auth::id())
            ->orderBy("id", "DESC")
            ->get();

        $totalPrice = $cartItems->filter(function ($cartItem) {
            return $cartItem->product !== null; // Product bilgisi olanları filtrele
        })->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        return Inertia::render("Cart/Index", compact("cartItems", "totalPrice"));
    }

    public function getIndex()
    {
        $cartItems = Cart::with("product")
            ->where("user_id", Auth::id())
            ->orderBy("id", "DESC")
            ->get();

        $totalPrice = $cartItems->filter(function ($cartItem) {
            return $cartItem->product !== null; // Product bilgisi olanları filtrele
        })->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        return response()->json([
            "cartItems" => $cartItems,
            "totalPrice" => $totalPrice
        ]);
    }

    // Count cart item
    public function countCartItem()
    {
        $cartItems = Cart::where("user_id", Auth::id())
            ->orderBy("id", "DESC")
            ->get();

        // topalam ürün miktarı
        $totalQuantity = $cartItems->sum("quantity");

        return response()->json([
            "cartItems" => $cartItems,
            "totalQuantity" => $totalQuantity
        ]);
    }

    // Sepetteki ürünlerin miktarını artırma
    public function incrementQuantity($cartId)
    {
        $cartItemIncrement = Cart::where("id", $cartId)
            ->where("user_id", Auth::id())
            ->first();

        if ($cartItemIncrement) {
            $cartItemIncrement->quantity += 1;
            $cartItemIncrement->save();
        }

        return response()->json([
            "cartItemIncrement" => $cartItemIncrement
        ]);
    }

    // Sepetteki ürünlerin miktarını azaltma
    public function decrementQuantity($cartId)
    {
        $cartItemDecrement = Cart::where("id", $cartId)
            ->where("user_id", Auth::id())
            ->first();

        if ($cartItemDecrement->quantity > 1) {
            $cartItemDecrement->quantity -= 1;
            $cartItemDecrement->save();
        } else {
            $cartItemDecrement->delete();
        }

        return response()->json([
            "cartItemDecrement" => $cartItemDecrement
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => ["required"]
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        // Ürün kullanıcı sepetinde olup olmadığını kontrol etme
        $cartItem = Cart::where("user_id", $userId)
            ->where("product_id", $productId)
            ->first();

        // Eğer ürün aynı kullanıcıda varsa yalnız quantity miktarını artır 
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // ürün sepette yoksa yeni bir tane oluştur
            Cart::create(
                [
                    "user_id" => $userId,
                    "product_id" => $productId,
                    'quantity' => 1
                ]
            );
        }

        return redirect()->route("dashboard");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
