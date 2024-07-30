<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy("id", "DESC")->get();
        $categories = Category::orderBy("id", "DESC")->get();
        return Inertia::render("Product/Index", compact("products", "categories"));
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
            "category_id" => ["required"],
            "name" => ["required"],
            "description" => ["nullable"],
            "stock" => ["nullable"],
            "price" => ["required"],
            "image" => ["required", "image", "mimes:png,jpg,jpeg,svg", "max:2048"],
        ]);

        if ($request->file("image")) {
            $image = $request->file("image");
            $imageName = time() . "." . $image->getClientOriginalExtension();
            // create new image instance
            $imgManager = new ImageManager(new Driver());
            $imgSize = $imgManager->read($image);
            $imgSize->cover(300, 200);
            $imgSize->save(public_path("products/" . $imageName));
        }

        Product::create([
            "category_id" => $request->category_id,
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "price" => $request->price,
            "image" => $imageName,
        ]);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy("id", "DESC")->get();
        return Inertia::render("Product/EditProduct", compact("product", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "category_id" => ["required"],
            "name" => ["required"],
            "description" => ["nullable"],
            "stock" => ["nullable"],
            "price" => ["required"],
            "image" => ["nullable", "image", "mimes:png,jpg,jpeg,svg", "max:2048"]
        ]);

        $imageName = $product->image; // Mevcut görüntü adı
        if ($request["images"]) {
            // mevcut görüntüyü silme
            if ($product->image && file_exists(public_path("products/" . $product->image))) {
                unlink(public_path("products/" . $product->image));
            }

            $image = $request->file("image");
            $imageName = time() . "." . $image->getClientOriginalExtension();
            // create new image instance
            $imgManager = new ImageManager(new Driver());
            $imgSize = $imgManager->read($image);
            $imgSize->cover(800, 600);
            $imgSize->save(public_path("products/" . $imageName));
        }

        $product->update([
            "category_id" => $request->category_id,
            "name" => $request->name,
            "description" => $request->description,
            "stock" => $request->stock,
            "price" => $request->price,
            "image" => $imageName,
        ]);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // mevcut görüntüyü silme
        if ($product->image && file_exists(public_path("products/" . $product->image))) {
            unlink(public_path("products/" . $product->image));
        }
        $product->delete();
        return redirect()->route('product.index');
    }
}
