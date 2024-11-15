<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("category.index", compact("categories"));
    }

    public function create()
    {
        return view("category.create");
    }

    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('description', $request->description);
        $request->validate([
            "name" => "required|unique:categories,name",
            "description" => "required",
        ], [
            "name.required" => "Kategori harus diisi",
            "name.unique" => "Kategori sudah terdaftar",
            "description.required" => "Deskripsi harus diisi",
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);        

        return redirect()->route("category.index")->with('success', 'Kategori telah ditambahkan ke daftar!');
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view("category.edit", compact("category"));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|unique:categories,name," . $id,
            "description" => "required",
        ], [
            "name.required" => "Kategori harus diisi",
            "name.unique" => "Kategori sudah terdaftar",
            "description.required" => "Deskripsi harus diisi",
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route("category.index")->with('success', 'Kategori produk telah di update!');
    }

    public function destroy(string $id)
    {
        $id = Category::findOrFail($id)->delete();
        return redirect()->route("category.index")->with('success', 'Kategori produk telah di hapus!');
    }
}
