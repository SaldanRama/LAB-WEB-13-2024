<x-layout>
    <div class="bg-purple-50 min-h-screen p-6">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-purple-700">Products</h1>
            <a href="{{ route('Product.create') }}" 
               class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create New Product
            </a>
        </div>

        <form method="GET" action="{{ route('Product.index') }}" class="mb-6">
            <label for="category" class="block text-sm font-medium text-gray-700">Filter by Category:</label>
            <select id="category" name="category" class="block w-full mt-1 bg-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option class="color-indigo" value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="mt-3 inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-300">
                Filter
            </button>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <div class="p-4">
                    <h1 class="text-xl font-bold text-purple-700 mb-2">
                        <a href="{{ route('Product.show', $product->id) }}" class="hover:underline">{{$product->name}}</a>
                    </h1>
                    <h2 class="text-lg text-gray-600 mb-1">{{ $product->Category?->name ?? 'No Category'}}</h2>
                    <h2 class="text-lg text-gray-600 mb-1">Price: ${{$product->price}}</h2>
                    <h2 class="text-lg text-gray-600 mb-1">Quantity: {{$product->stock}}</h2>
                    <p class="text-gray-500 mb-4">{{$product->description}}</p>
                    <a href="{{route('Product.show', $product->id)}}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        View Product
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>
