<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();

        if ($request->has('category') && $request->category != '') {
            $products->where('category_id', $request->category);
        }

        $products = $products->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view("products.create", compact("categories"));
    }


    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('description', $request->description);
        Session::flash('price', $request->price);
        Session::flash('category_id', $request->category_id);
        Session::flash('stock', $request->stock);

        $request->validate([
            "name" => "required|unique:products,name",
            "description" => "required",
            "price" => "required|numeric",
            "category_id" => "required|exists:categories,id",
            "stock" => "required|numeric",
        ], [
            "name.required" => "Nama produk ga boleh kosong.",
            "name.unique" => "Nama produk udah ada, edit aja produknya kalo mau ngubah.",
            "description.required" => "Deskripsi ga boleh kosong.",
            "price.required" => "Harga ga boleh kosong.",
            "category_id.exists" => "Kategori ga ada.",
            "stock.required" => "Stock ga boleh kosong.",
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
        ]);

        return redirect()->route("products.index")->with('success', 'Produk udah ditambahkan');
    }

    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view("products.edit", compact("product", "categories"));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|unique:products,name," . $id,
            "description" => "required",
            "price" => "required|numeric",
            "category_id" => "required|exists:categories,id",
            "stock" => "required|numeric",
        ], [
            "name.required" => "Nama Produk ga boleh kosong.",
            "name.unique" => "Nama produk udah ada, edit aja produknya kalo mau ngubah.",
            "description.required" => "Deskripsi ga boleh kosong.",
            "price.required" => "Harga ga boleh kosong.",
            "category_id.exists" => "Kategori ga ada.",
            "stock.required" => "Stock ga boleh kosong.",
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
        ]);

        return redirect()->route("products.index")->with('success', 'Produk udah di-update');
    }

    public function destroy(string $id)
    {
        $id = Product::findOrFail($id)->delete();
        return redirect()->route("products.index")->with('success', 'Produk telah dipetrus (dihapus)');
    }
}
