<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\InventoryLog;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Categories::all(); 
    
        $categoryName = $request->input('category');
    
        if ($categoryName) {
            $products = Product::whereHas('Category', function ($query) use ($categoryName) {
                $query->where('name', $categoryName);
            })->with('Category')->get();
        } else {
            $products = Product::with('Category')->get();
        }
    
        return view('Product.index', compact('products', 'categories', 'categoryName'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('Product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);




    
        $product = Product::create($validated);

        InventoryLog::create([
            'product_id' => $product->id,
            'type' => 'restock',
            'quantity' => $product->stock,
            'created_at' => now()
        ]);


        return redirect()->route('Product.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $Product)
    {
        return view('Product.show', compact('Product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $Product)
    {
        $categories = Categories::all();
        return view('Product.edit',compact('Product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $Product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
    
        $oldStock = $Product->stock;
    
        $Product->update($validated);
    
        $stockChange = $validated['stock'] - $oldStock; 
    
        if ($stockChange > 0) {
            InventoryLog::create([
                'product_id' => $Product->id,
                'type' => 'restock',
                'quantity' => $stockChange,  
                'created_at' => now(),
            ]);
        } elseif ($stockChange < 0) {
            InventoryLog::create([
                'product_id' => $Product->id,
                'type' => 'sold',
                'quantity' => abs($stockChange), 
                'created_at' => now(),
            ]);
        }
    
        return redirect()->route('Product.index')
            ->with('status', 'Product edited successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $Product)
    {
        $Product -> delete();
        return redirect()->route('Product.index')  
                        ->with('status','Product Deleted Successfully');
    }
}
