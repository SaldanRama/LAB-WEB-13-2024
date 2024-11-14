<x-layout>
    <div class="bg-gradient-to-br from-purple-50 to-indigo-50 min-h-screen p-6">
        <div class="max-w-7xl mx-auto">

            <nav class="flex mb-8 text-gray-600" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('Product.index') }}" class="hover:text-purple-600 transition-colors">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Products
                        </a>
                    </li>
                    <li aria-current="page" class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500 ml-1">{{ $Product->name }}</span>
                    </li>
                </ol>
            </nav>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="relative h-48 bg-gradient-to-r from-purple-600 to-indigo-600">
                    <div class="absolute bottom-0 left-0 right-0 px-8 py-6 bg-gradient-to-t from-black/50">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $Product->name }}</h1>
                        <div class="flex items-center space-x-4">
                            <span class="px-3 py-1 bg-purple-500 text-white rounded-full text-sm">
                                {{ $Product->Category?->name ?? 'No Category' }}
                            </span>
                            <span class="text-white/90">ID: #{{ $Product->id }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8 p-8">
                    <div class="space-y-6">
                        <div class="bg-purple-50 rounded-xl p-6">
                            <h2 class="text-xl font-semibold text-purple-800 mb-4">Product Details</h2>
                            <div class="prose max-w-none text-gray-600">
                                {{ $Product->description }}
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Price</h3>
                                <p class="text-2xl font-bold text-purple-600">${{ number_format($Product->price, 2) }}
                                </p>
                            </div>
                            <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Stock</h3>
                                <p
                                    class="text-2xl font-bold {{ $Product->stock > 10 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $Product->stock }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Stock Status</h3>
                            <div class="relative pt-1">
                                <div class="overflow-hidden h-4 text-xs flex rounded-full bg-gray-200">
                                    <div style="width: {{ min(($Product->stock / 100) * 100, 100) }}%"
                                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center {{ $Product->stock > 10 ? 'bg-green-500' : 'bg-red-500' }}">
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-600">
                                    @if ($Product->stock > 500)
                                        <span class="text-green-600 font-semibold">In Stock</span> - Good inventory
                                        levels
                                    @elseif($Product->stock > 300)
                                        <span class="text-yellow-600 font-semibold">Limited Stock</span> - Order soon
                                    @else
                                        <span class="text-red-600 font-semibold">Low Stock</span> - Running out
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4">
                            <a href="{{ route('Product.edit', $Product) }}"
                                class="flex-1 px-6 py-3 bg-purple-600 text-white text-center rounded-lg hover:bg-purple-700 transition-colors duration-300 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Product
                            </a>
                            <form action="{{ route('Product.destroy', $Product) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300 flex items-center justify-center"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Delete Product
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 px-8 py-6 bg-gray-50">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Product Timeline</h2>
                    <div class="space-y-4">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm text-gray-500">Created at</p>
                                <p class="mt-0.5 text-sm text-gray-800">
                                    {{ $Product->created_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm text-gray-500">Last updated</p>
                                <p class="mt-0.5 text-sm text-gray-800">
                                    {{ $Product->updated_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
