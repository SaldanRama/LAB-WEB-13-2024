@extends('layouts.app')

@section('content')
<br><br>
<div class="max-w-md mx-auto px-4 py-8 bg-white [--shadow:rgba(60,64,67,0.3)_0_1px_2px_0,rgba(60,64,67,0.15)_0_2px_6px_2px] m-auto w-4/5 h-auto rounded-2xl bg-white [box-shadow:var(--shadow)] max-w ">
    <div class="flex justify-center">
        <h2 class="text-4xl font-bold text-[#A78295] text-center">Edit Category</h2>
    </div>
    <div class="mt-6">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="block text-lx font-bold text-[#000]">Name</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 text-red-900 @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="block text-lx font-bold text-[#000]">Description</label>
                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 text-red-900 @enderror" id="description" name="description" rows="3" required>{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-between">
                <a href="{{ route('categories.index') }}" class="py-2 px-6 bg-[#d32323] rounded-l-lg text-white text-center flex-1 mx-1">
                    Batal
                </a>
                <button type="submit" class="py-2 px-6 bg-[#A78295] rounded-r-lg text-white text-center flex-1 mx-1">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection