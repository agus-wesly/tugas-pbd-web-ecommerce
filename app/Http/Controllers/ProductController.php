<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ProductList', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ProductAdd', [
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productData = $request->validate([
            'name' => 'required|min:2|max:255' ,
            'description' => 'required|min:5|max:255' ,
            'stock' => 'required|integer|min:5|max:255' ,
            'product_url' => 'required|min:5|max:255' ,
            'price' => 'required|integer|min:5' ,
            'type_id' => 'required|integer' 
        ]);

        Product::create($productData);
        return to_route('dashboard-product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $relatedProduct = Product::where([
            'type_id' => $product->type_id
        ])->get();
        
        return Inertia::render('ProductList', [
            'product' => $product,
            'relatedProduct' => $relatedProduct,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return to_route('dashboard-product');
    }
}
