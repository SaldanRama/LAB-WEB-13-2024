<nav class="bg-blue-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="#"
                        class="text-2xl font-serif text-white tracking-widest hover:text-sky-500 transition-colors duration-300 drop-shadow-md">
                        INVENTORY
                    </a>
                </div>
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="{{ route('products.index') }}"
                        class="{{ request()->routeIs('products.index') ? 'bg-sky-900 text-sky-500 border-b-4 border-sky-500' : 'text-gray-300 hover:bg-sky-900 hover:text-sky-400' }} px-3 py-2 rounded-t-md text-sm font-medium">
                        Products
                    </a>
                    <a href="{{ route('category.index') }}"
                        class="{{ request()->routeIs('category.index') ? 'bg-sky-900 text-sky-500 border-b-4 border-sky-500' : 'text-gray-300 hover:bg-sky-900 hover:text-sky-400' }} px-3 py-2 rounded-t-md text-sm font-medium">
                        Categories
                    </a>
                    <a href="{{ route('inventoryLog.index') }}"
                        class="{{ request()->routeIs('inventoryLog.index') ? 'bg-sky-900 text-sky-500 border-b-4 border-sky-500' : 'text-gray-300 hover:bg-sky-900 hover:text-sky-400' }} px-3 py-2 rounded-t-md text-sm font-medium">
                        Products Log
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

