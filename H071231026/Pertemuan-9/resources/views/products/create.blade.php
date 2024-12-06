@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div
            class="bg-white shadow-lg rounded-2xl w-full max-w-lg mx-4 pt-3 pb-6 px-4 [--shadow:rgba(60,64,67,0.3)_0_1px_2px_0,rgba(60,64,67,0.15)_0_2px_6px_2px] [box-shadow:var(--shadow)]">
            <div class="pb-0">
                <div class="flex justify-center">
                    <h2 class="text-2xl font-bold text-[#A78295] text-center">Add Product</h2>
                </div>
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <br>
                        <select
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md appearance-none font-medium"
                            id="category_id" name="category_id" required style="font-family: 'Poppins', sans-serif;">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="block text-sm font-bold text-[#000]">Name</label>
                        <input type="text"
                            class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 flex gap-4">
                        <div class="w-1/2">
                            <label for="price" class="block text-sm font-bold text-[#000]">Price</label>
                            <div class="flex items-center">
                                <span class="mr-2">Rp.</span>
                                <input type="number"
                                    class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    id="price" name="price" value="{{ old('price') }}" step="1" min="0"
                                    required>
                            </div>
                            @error('price')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="stock" class="block text-sm font-bold text-[#000]">Stock</label>
                            <input type="number"
                                class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                id="stock" name="stock" value="{{ old('stock') }}" min="0" required>
                            @error('stock')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="block text-sm font-bold text-[#000]">Description</label>
                        <textarea
                            class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            id="description" name="description" rows="1" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-between">
                        <a href="{{ route('products.index') }}"
                            class="py-2 px-6 bg-[#d32323] rounded-l-lg text-white text-center flex-1 mx-1">Cancel</a>
                        <button type="submit"
                            class="py-2 px-6 bg-[#A78295] rounded-r-lg text-white text-center flex-1 mx-1">Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
