<x-layout>
    <div class="bg-gradient-to-br from-purple-50 to-purple-100 min-h-screen p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($inventoryLogs as $log)
            <div class="bg-white shadow-xl rounded-lg p-6 transform hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 ease-out">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-purple-700 tracking-wide">
                        <a href="#" class="hover:underline hover:text-purple-900 transition-colors duration-300">{{ ucfirst($log->type) }}</a>
                    </h1>
                    <span class="text-sm text-gray-500">{{ $log->created_at->format('M d, Y') }}</span>
                </div>
                <h2 class="text-lg text-gray-800 font-semibold mb-2">
                    Quantity: <span class="text-purple-600">{{ $log->quantity }}</span>
                </h2>
                <p class="text-gray-600 text-base mb-4">
                    Product: <span class="font-semibold">{{ $log->Product->name }}</span>
                </p>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>
