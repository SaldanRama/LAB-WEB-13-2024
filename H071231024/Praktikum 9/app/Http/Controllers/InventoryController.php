<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
{
    public function index()
    {
        $inventoryLogs = InventoryLog::all();
        $products = Product::all();
        return view("inventoryLog.index", compact("inventoryLogs", 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view("inventoryLog.create", compact("products"));
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        if ($product == null) {
            return redirect()->route('inventoryLog.index')->with('error', 'Produk tidak ditemukan!');
        }

        if ($request->type == 'restock') {
            $newStock = $product->stock + $request->quantity;
        } elseif ($request->type == 'sold') {
            if ($product->stock >= $request->quantity) {
                $newStock = $product->stock - $request->quantity;
            } else {
                return redirect()->route('inventoryLog.create')->with('error', 'Stok produk tidak mencukupi!');
            }
        } else {
            return redirect()->route('inventoryLog.create')->with('error', 'Tipe transaksi tidak valid!');
        }

        $inventory = InventoryLog::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'type' => $request->type,
        ]);

        $product->stock = $newStock;
        $product->save();

        return redirect()->route('inventoryLog.index')->with('success', 'Log produk telah di update!');
    }

    public function destroy(string $id)
    {
        $id = InventoryLog::findOrFail($id)->delete();
        return redirect()->route('inventoryLog.index')->with('success', 'Log produk telah di hapus!');
    }
}
