@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div
            class="bg-white shadow-lg rounded-2xl w-full max-w-lg mx-4 p-1 [--shadow:rgba(60,64,67,0.3)_0_1px_2px_0,rgba(60,64,67,0.15)_0_2px_6px_2px] [box-shadow:var(--shadow)]">
            <div class="px-4 py-3 sm:px-6">
                <div class="flex justify-center">
                    <h2 class="text-2xl font-bold text-[#A78295] text-center mb-0">Add Inventory Log</h2>
                </div>
                <form action="{{ route('inventory-logs.store') }}" method="POST">
                    @csrf
                    <div class="mb-1">
                        <label for="product_id" class="block text-lg font-bold text-[#000]">Product</label>
                        <select
                            class="block w-full pl-3 pr-10 py-1 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md appearance-none"
                            id="product_id" name="product_id" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (Current Stock: {{ $product->stock }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="type" class="block text-lg font-bold text-[#000]">Type</label>
                        <select
                            class="block w-full pl-3 pr-10 py-1 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md appearance-none"
                            id="type" name="type" required>
                            <option value="restock" {{ old('type') == 'restock' ? 'selected' : '' }}>Restock</option>
                            <option value="sold" {{ old('type') == 'sold' ? 'selected' : '' }}>Sold</option>
                        </select>
                        @error('type')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="quantity" class="block text-lg font-bold text-[#000]">Quantity</label>
                        <input type="number"
                            class="block w-full px-3 py-1 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" required>
                        @error('quantity')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-between mt-3">
                        <a href="{{ route('inventory-logs.index') }}"
                            class="py-2 px-6 bg-[#d32323] rounded-l-lg text-white text-center flex-1 mx-1">Cancel</a>
                        <button type="submit"
                            class="py-2 px-6 bg-[#A78295] rounded-r-lg text-white text-center flex-1 mx-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
