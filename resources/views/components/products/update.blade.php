@extends('layouts.master')

@section('content')

    <div class="flex justify-center mt-4 content-center">
        <form action="{{ route('products.update-product', ['id' => $product->id]) }}" method="POST" class="mx-8 mb-6 bg-white rounded-lg w-1/2">
            <div class="flex mr-6 mt-4 ">
                <a onclick="return confirm('Are you sure you want to delete this user?')" href="{{ route('products.delete-product', ['id' => $product->id]) }}" 
                class="ml-auto flex items-center text-red-500 font-medium text-lg hover:px-3 hover:py-1 hover:bg-red-500 
                hover:rounded-xl hover:text-white">
                    <span class="material-symbols-outlined ">
                        delete
                    </span>
                    <p>Delete</p>
                </a>
            </div>

            <p class="text-4xl font-light px-8 py-6 text-center">{{ $title }}</p>
            
            @if (session('msg'))
                <div class="bg-blue-200 border border-blue-400 text-black px-4 py-3 rounded">{{ session('msg') }}</div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">Invalid Data Input! Please try again.</div>
            @endif
            <div class="px-6 py-3">
                <p class="text-base font-medium text-zinc-700">Product Name</p>
                <input type="text" name="product_name" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Product Name..." value="{{ old('product_name') ?? $product->product_name }}">
                @error('product_name')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 py-3">
                <p class="text-base font-medium text-zinc-700">Amount</p>
                <input min="0" type="number" name="amount" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" value="{{ old('amount') ?? $product->amount }}">
                @error('amount')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 pb-3">
                <p class="text-base font-medium text-zinc-700">Category</p>
                <select class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" name="category_id">
                    <option>Select Category</option>
                    @if (! empty($categories))
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('id') == $category->id || $product->category_id == $category->id ? 'selected' : false}}>{{ $category->category }}</option>
                        @endforeach
                    @endif
                </select>
                @error('category_id')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 py-6 text-right">
                <button type="submit" class="ml-auto px-3 py-2 bg-blue-500 rounded-lg text-white h-full">Update new</button>
                <a href="{{ route('products.index') }}" class="ml-auto px-3 py-2 bg-yellow-400 rounded-lg h-full">Come back</a>
            </div>
            @csrf
        </form>
    </div>

@endsection