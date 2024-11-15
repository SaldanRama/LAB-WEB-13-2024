@extends('layouts.home')

@section('content')
    <div>
        <!-- Pindahkan tombol "Add Categories" ke sebelah kiri dan sejajarkan dengan tabel -->
        <div class="flex justify-start w-11/12 mx-auto mb-11 mt-8">
            <a href="{{ route('category.create') }}"
                class="bg-sky-500 hover:bg-sky-700 text-black font-bold py-2 px-4 rounded">Add Categories</a>
        </div>

        <!-- Tabel Categories -->
        <table class="table-auto w-11/12 border border-collapse mx-auto">
            <thead class="bg-blue-500">
                <tr>
                    <th scope="col"
                        class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">
                        Categories
                    </th>
                    <th scope="col"
                        class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">
                        Description
                    </th>
                    <th scope="col"
                        class="px-4 py-2 text-center text-base font-medium text-black uppercase tracking-wider">
                        Options
                    </th>
                </tr>
            </thead>
            <tbody class="bg-blue-600 divide-y divide-gray-200">
                @foreach ($categories as $category)
                    <tr class="border-b border-t">
                        <td class="px-4 py-2 text-center font-medium text-black tracking-wider">
                            {{ $category->name }}
                        </td>
                        <td class="px-4 py-2 text-center font-medium text-black tracking-wider">
                            {{ $category->description }}
                        </td>
                        <td class="px-4 py-2 text-center font-medium text-black tracking-wider">
                            <a href="{{ route('category.edit', $category->id) }}"
                                class="inline-block w-24 text-center hover:text-green-500 text-black font-bold py-2 px-4 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M17.414 2.586a2 2 0 0 1 0 2.828l-1.828 1.828-2.828-2.828L14.586 2.586a2 2 0 0 1 2.828 0zM2 13.586V17h3.414l9.293-9.293-2.828-2.828L2 13.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus kategori?')" class="inline-block">
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
