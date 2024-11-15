@extends('layouts/home')

@section('content')
    <div class="max-w-md mx-auto bg-blue-600 rounded-lg overflow-hidden shadow-md mb-16">
        <div class="px-6 py-4">
            <h2 class="text-2xl font-bold text-black mb-2">Create Product</h2>
            <form action="{{ route('inventoryLog.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="product_name" class="block text-black text-sm font-bold mb-2">Product Name :</label>
                    <div class="relative">
                        <select name="product_id" id="product_id"
                            class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 bg-blue-200 text-gray-700"
                            required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06 0L10 10.88l3.71-3.67a.75.75 0 111.06 1.06l-4 4a.75.75 0 01-1.06 0l-4-4a.75.75 0 010-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-black text-sm font-bold mb-2">Type :</label>
                    <div class="relative">
                        <select name="type" id="type"
                            class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 bg-blue-200 text-gray-700"
                            required>
                            <option value="">Select Type</option>
                            <option value="restock">Re-stock</option>
                            <option value="sold">Sold</option>
                            
                        </select>
                        <!-- Ikon panah dropdown -->
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06 0L10 10.88l3.71-3.67a.75.75 0 111.06 1.06l-4 4a.75.75 0 01-1.06 0l-4-4a.75.75 0 010-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block text-black text-sm font-bold mb-2">Amount :</label>
                    <input type="number" name="quantity" id="quantity"
                        class="w-full px-3 py-2 border bg-blue-200 border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        required min="0">
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('inventoryLog.index') }}"
                        class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-900 mr-2">Back</a>
                    <button type="submit"
                        class="px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-900">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
