<x-layout>
    <div class="bg-purple-50 min-h-screen p-6">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold text-purple-700 mb-6">Edit {{$Product->name}}</h1>

            <form action="{{ route('Product.update',$Product) }}" method="POST" class="space-y-6">
                @method('PATCH')
                @csrf

                <div class="space-y-2">

                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           placeholder="{{ $Product->name }}"
                           value="{{ old('name', $product->name ?? '') }}"
                           class="mt-1 bg--500 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50 text-purple-700 placeholder-gray-400  "
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">


                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <h1 class="text-s text-purple-700 mb-6">Current Category: {{$Product->Category->name}}</h1>
                    <select name="category_id" 
                            id="category_id"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                            required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ (old('category_id', $product->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Product Description</label>
                    <textarea name="description" 
                              id="description" 
                              placeholder="{{ $Product->description }}"
                              rows="4"
                              class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                    <input type="number" 
                           name="price" 
                           id="price" 
                           placeholder="{{ $Product->price }}"
                           value="{{ old('price', $product->price ?? '') }}"
                           step="0.01"
                           min="0"
                           class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                           required>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                    <input type="number" 
                           name="stock" 
                           id="stock" 
                           placeholder="{{ $Product->stock }}"
                           value="{{ old('stock', $product->stock ?? '') }}"
                           min="0"
                           class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                           required>
                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('Product.index') }}" 
                       class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-300">
                        Edit Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>