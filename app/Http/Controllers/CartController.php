<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
