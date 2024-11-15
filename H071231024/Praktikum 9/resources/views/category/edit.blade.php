@extends('layouts.home')

@section('content')
    <div class="max-w-md mx-auto bg-blue-600 rounded-lg overflow-hidden shadow-md mb-16">
        <div class="px-6 py-4">
            <h2 class="text-2xl font-bold mb-2 text-black">Edit Kategori</h2>
            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-black text-sm font-bold mb-2">Nama:</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 border bg-blue-200 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        value="{{ $category->name }}" required> </input>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-black text-sm font-bold mb-2">Deskripsi:</label>
                    <input name="description" id="description"
                        class="w-full px-3 py-2 border bg-blue-200 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        value="{{ $category->description }}" required></input>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('category.index') }}"
                        class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-900 mr-2">Kembali</a>
                    <button type="submit"
                        class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
