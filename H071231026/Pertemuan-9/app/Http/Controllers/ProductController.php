<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255|unique:products,name',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0'
            ], [
                'category_id.required' => 'Category must be selected',
                'category_id.exists' => 'Invalid category',
                'name.required' => 'Product name is required',
                'name.max' => 'Product name cannot exceed 255 characters',
                'name.unique' => 'Product name already exists, please use another name',
                'description.required' => 'Description is required',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price must be a number',
                'price.min' => 'Price cannot be less than 0',
                'stock.required' => 'Stock is required',
                'stock.integer' => 'Stock must be a whole number',
                'stock.min' => 'Stock cannot be less than 0'
            ]);

            DB::transaction(function () use ($request) {
                $product = Product::create($request->all());
                
                InventoryLog::create([
                    'product_id' => $product->id,
                    'type' => 'restock',
                    'quantity' => $request->stock,
                    'date' => now()
                ]);
            });

            return redirect()->route('products.index')
                ->with('success', 'Product successfully added.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to add product. Please try again.');
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255|unique:products,name,'.$product->id,
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0'
            ], [
                'category_id.required' => 'Category must be selected',
                'category_id.exists' => 'Invalid category',
                'name.required' => 'Product name is required',
                'name.max' => 'Product name cannot exceed 255 characters',
                'name.unique' => 'Product name already exists, please use another name',
                'description.required' => 'Description is required',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price must be a number',
                'price.min' => 'Price cannot be less than 0',
                'stock.required' => 'Stock is required',
                'stock.integer' => 'Stock must be a whole number',
                'stock.min' => 'Stock cannot be less than 0'
            ]);

            DB::transaction(function () use ($request, $product) {
                $oldStock = $product->stock;
                $newStock = $request->stock;
                
                if ($oldStock != $newStock) {
                    $difference = $newStock - $oldStock;
                    InventoryLog::create([
                        'product_id' => $product->id,
                        'type' => $difference > 0 ? 'restock' : 'sold',
                        'quantity' => abs($difference),
                        'date' => now()
                    ]);
                }
                
                $product->update($request->all());
            });

            return redirect()->route('products.index')
                ->with('success', 'Product successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('products.index')
                ->with('success', 'Product successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete product. Please try again.');
        }
    }
}
