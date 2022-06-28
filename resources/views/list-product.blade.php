@extends('layouts.master')

@section('content')

<div class="flex items-center px-8 py-6">
    <p class="text-4xl font-light">{{ $title }}</p>
    <a href="{{ route('products.show-add') }}" class="ml-auto px-3 py-2 bg-blue-500 rounded-lg text-white h-full">Create new</a>
</div>

<div class="relative overflow-x-auto shadow-md rounded-lg mx-8">
    <table class="w-full text-sm text-left bg-white rounded-lg">
        <thead class="font-medium text-gray-800 uppercase bg-zinc-200 rounded-lg">
            <tr>
                <td class="px-6 py-3">STT</td>
                <td class="px-6 py-3 hover:text-red-500">
                    <a>Name Product</a>
                    
                </td>
                <td class="px-6 py-3 hover:text-red-500">
                    <a>Amount of Product</a>
                </td>
                <td class="px-6 py-3"">Category</th>
                <td class="px-6 py-3">State</td>
                <td class="text-right px-4 py-3">
                    <form action="{{ route('products.delete-all-product') }}" method="POST"> 
                        @method('delete')
                        <button onclick="return confirm('Are you sure you want to delete this user?')"
                        class="ml-auto inline-flex items-center text-blackfont-medium text-red-500 hover:px-2 hover:py-1 hover:bg-red-500 
                        hover:rounded-xl hover:text-white">
                            <span class="material-symbols-outlined ">
                                delete
                            </span>
                            <p>Delete</p>
                        </button>
                        @csrf
                    </form>
                    
                </td>
            </tr>
        </thead>
        <tbody>
            @if (! empty($products))

                @foreach ($products as $key => $product)
                    <tr>
                        <td class="px-6 py-3">{{ $key + 1 }}</td>
                        <td class="px-6 py-3">{{ $product->product_name }}</td>
                        <td class="px-6 py-3">{{ $product->amount }}</td>
                        <td class="px-6 py-3">
                            @if ($product->category_id == 2)
                                {!! '<p class="text-center font-medium w-28 py-0 bg-pink-400 text-white rounded-md">Cake</p>' !!}
                            @elseif($product->category_id == 3)
                                {!! '<p class="text-center font-medium w-28 py-0 bg-teal-500 text-white rounded-md">Drink</p>' !!}
                            @else
                                {!! '<p class="text-center font-medium w-28 py-0 bg-red-500 text-white rounded-md">Food</p>' !!}
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            @if($product->state == 0 && $product->amount == 0)
                                {!! '<p class="text-center font-medium w-22 py-0 bg-zinc-400 text-white rounded-md">Out of stock</p>' !!}
                            @else
                                {!! '<p class="text-center font-medium w-22 py-0 bg-blue-600 text-white rounded-md">Stocking</p>' !!}
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right">
                            <a href="{{ route('products.update-product', ['id' => $product->id]) }}" class="px-3 py-2 bg-zinc-200 rounded-md">Quản lý</a>
                        </td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table>
    <div class="px-2 py-2">
        {{ $products->links()  }}
    </div>
</div>


@endsection