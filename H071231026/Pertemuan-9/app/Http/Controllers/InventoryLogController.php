<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryLogController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::with('product')->orderBy('date', 'desc')->get();
        return view('inventory_logs.index', compact('logs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory_logs.create', compact('products'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'type' => 'required|in:restock,sold',
                'quantity' => 'required|integer|min:1',
            ], [
                'product_id.required' => 'Product must be selected',
                'product_id.exists' => 'Invalid product',
                'type.required' => 'Transaction type is required',
                'type.in' => 'Invalid transaction type',
                'quantity.required' => 'Quantity is required',
                'quantity.integer' => 'Quantity must be a whole number',
                'quantity.min' => 'Quantity must be at least 1'
            ]);

            DB::transaction(function () use ($request) {
                $product = Product::findOrFail($request->product_id);

                if ($request->type === 'sold' && $product->stock < $request->quantity) {
                    throw new \Exception('Available stock is insufficient.');
                }

                // Update product stock
                $product->stock += ($request->type === 'restock' ? $request->quantity : -$request->quantity);
                $product->save();

                // Create inventory log
                InventoryLog::create([
                    'product_id' => $request->product_id,
                    'type' => $request->type,
                    'quantity' => $request->quantity,
                    'date' => now(),
                ]);
            });

            return redirect()->route('inventory-logs.index')
                ->with('success', 'Inventory log successfully created.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage() ?: 'Failed to create inventory log. Please try again.');
        }
    }

    public function destroy(InventoryLog $log)
    {
        try {
            DB::transaction(function () use ($log) {
                // Reverse the stock changes
                $product = $log->product;
                $product->stock += ($log->type === 'sold' ? $log->quantity : -$log->quantity);
                $product->save();

                $log->delete();
            });

            return redirect()->route('inventory-logs.index')
                ->with('success', 'Inventory log successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete inventory log. Please try again.');
        }
    }

}