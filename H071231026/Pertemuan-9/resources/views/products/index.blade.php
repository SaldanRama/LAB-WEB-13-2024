@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

        <div>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-5xl font-bold text-[#3F2E3E]">Product Management</h2>
            <a href="{{ route('products.create') }}"
                style="padding: 10px; background-color:#3F2E3E; border-radius: 10px; color: #fff">
                <i class="fas fa-plus"></i> Product
            </a>
        </div>

        <div
            class="bg-white shadow overflow-hidden sm:rounded-md [--shadow:rgba(60,64,67,0.3)_0_1px_2px_0,rgba(60,64,67,0.15)_0_2px_6px_2px]  rounded-2xl bg-white [box-shadow:var(--shadow)]">
            <div class="px-4 py-5 sm:px-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#3F2E3E] uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#3F2E3E] uppercase tracking-wider">
                                Category</th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#3F2E3E] uppercase tracking-wider">
                                Description</th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#3F2E3E] uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#3F2E3E] uppercase tracking-wider">
                                Stock
                            </th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#3F2E3E] uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $product->category->name }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $product->description }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">Rp.
                                    {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $product->stock }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-right">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-lx font-large text-white bg-[#A78295] hover:bg-[#A78295]">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-lx font-large text-white bg-red-600 hover:bg-red-700">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cursor-pointer"
                                            onclick="return confirm('Anda yakin?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
