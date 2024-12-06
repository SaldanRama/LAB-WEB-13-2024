@extends('layouts.app')

@section('content')
<div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white shadow-lg rounded-2xl w-full max-w-lg mx-4 p-6 [--shadow:rgba(60,64,67,0.3)_0_1px_2px_0,rgba(60,64,67,0.15)_0_2px_6px_2px] [box-shadow:var(--shadow)]">
        <div class="px-4 py-5 sm:px-6">
            <div class="flex justify-center">
                <h2 class="text-2xl font-bold text-[#A78295] text-center">Add Category</h2>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block text-lx font-bold text-[#000]">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 text-red-900 @enderror">
                    @error('name')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="block text-lx font-bold text-[#000]">Description</label>
                    <textarea id="description" name="description" rows="2" required
                              class="block w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 text-red-900 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-between">
                    <a href="{{ route('categories.index') }}" class="py-2 px-6 bg-[#d32323] rounded-l-lg text-white text-center flex-1 mx-1">
                        Cancel
                    </a>
                    <button type="submit" class="py-2 px-6 bg-[#A78295] rounded-r-lg text-white text-center flex-1 mx-1">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection