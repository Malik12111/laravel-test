<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {public function index()
{
    $products = [
        [
            'id' => 1,
            'product_name' => 'Sample Product 1',
            'leo_price' => 29.99,
            'malik_stock' => 10,
            'product_category' => 'Electronics'
        ],
        [
            'id' => 2,
            'product_name' => 'Sample Product 2', 
            'leo_price' => 49.99,
            'malik_stock' => 5,
            'product_category' => 'Accessories'
        ]
    ];
    
    return view('products.index', compact('products'));
}
        //
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
