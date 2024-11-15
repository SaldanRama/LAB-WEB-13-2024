@extends('layouts.home')

@section('content')
    <div>
        <!-- Container untuk tombol "Manage Products" disesuaikan dengan lebar tabel -->
        <div class="flex justify-start w-11/12 mx-auto mb-10 mt-8">
            <a href="{{ route('inventoryLog.create') }}"
                class="bg-sky-500 hover:bg-sky-700 text-black font-bold py-2 px-4 rounded">Manage Products</a>
        </div>

        <!-- Tabel Inventory Logs -->
        <table class="table-auto w-11/12 border border-collapse mx-auto">
            <thead>
                <tr class='bg-blue-500 border-b border-t'>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Names</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Types</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Amounts</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Dates</th>
                    <th class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventoryLogs as $inventoryLog)
                    <tr class="bg-blue-600 border-b">
                        <td class="px-4 py-2 text-center text-black">{{ $inventoryLog->product->name }}</td>

                        <td class="px-4 py-2 text-center">
                            <span
                                class="{{ $inventoryLog->type == 'sold' ? 'bg-red-600 text-black' : ($inventoryLog->type == 'restock' ? 'bg-green-500 text-black' : '') }} px-2 py-1 rounded-lg">
                                {{ $inventoryLog->type }}
                            </span>
                        </td>

                        <td class="px-4 py-2 text-center text-black">{{ $inventoryLog->quantity }}</td>
                        <td class="px-4 py-2 text-center text-black">{{ $inventoryLog->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 text-center text-black">
                            <form action="{{ route('inventoryLog.destroy', $inventoryLog->id) }}" method="POST"
                                onsubmit="return confirm('Yakin mau menghapus produk?')" class="inline-block">
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
