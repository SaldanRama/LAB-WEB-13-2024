@extends('layouts.home')

@section('content')
    <div class="mr-14 ml-14 mb-10 mt-8">
        
        <div class="flex justify-between items-center w-11/12 mx-auto mb-4">
            
            <div>
                <a href="{{ route('products.create') }}"
                    class="bg-sky-500 hover:bg-sky-700 text-black font-bold px-4 py-2 rounded-md">Add Products</a>
            </div>

            <div class="flex items-center">
                <div class="w-full max-w-xs">
                    <label for="category" class="block text-black text-sm font-bold mb-2">Filter by Category:</label>
                    <form action="{{ route('products.index') }}" method="GET" class="flex items-center">
                        <div class="relative w-full">
                            <select name="category" id="category"
                                class="appearance-none w-full px-3 py-2 border border-slate-800 rounded-md focus:outline-none focus:border-indigo-500 bg-slate-800 text-white">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
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
                        <button type="submit"
                            class="ml-2 px-4 py-2 bg-sky-500 hover:bg-sky-700 text-black rounded-md">Filter</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Tabel Produk -->
        <table class="table-auto w-11/12 bg-blue-500 border border-collapse mt-5 mx-auto">
            <thead>
                <tr class='border-b border-t'>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Names</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Descriptions</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Categories</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Stock</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Prices</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class='border-b border-t bg-blue-600'>
                        <td class="px-4 py-2 text-center text-black">{{ $product->name }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $product->description }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $product->category->name }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $product->stock }}</td>
                        <td class="px-4 py-2 text-center text-black">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-center text-black">
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="inline-block w-24 text-center hover:text-green-500 text-black font-bold py-2 px-4 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M17.414 2.586a2 2 0 0 1 0 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 0 1 2.828 0zM2 13.586V17h3.414l9.293-9.293-2.828-2.828L2 13.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus produk?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-24 text-center hover:text-red-500 text-black font-bold py-2 px-4 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M6 7h12v12a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V7zm7-5a1 1 0 0 1 1-1v1h5a1 1 0 1 1 0 2H4a1 1 0 0 1 0-2h5V3a1 1 0 0 1 1-1h4z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
