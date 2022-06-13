@extends('layouts.master')

@section('content')

<div class="flex items-center px-8 py-6">
    <p class="text-4xl font-light">{{ $title }}</p>
    <a class="ml-auto px-3 py-2 bg-blue-500 rounded-lg text-white h-full">Create new</a>
</div>

<div class="relative overflow-x-auto shadow-md rounded-lg mx-8">
    <table class="w-full text-sm text-left bg-white rounded-lg">
        <thead class="font-medium text-gray-800 uppercase bg-zinc-200 rounded-lg">
            <tr>
                <td class="px-6 py-3">STT</td>
                <td class="px-6 py-3 hover:text-red-500">
                    <a>Name</a>
                    
                </td>
                <td class="px-6 py-3 hover:text-red-500">
                    <a>email</a>
                </td>
                <td class="px-6 py-3"">Role</th>
                <td class="px-6 py-3">State</td>
                <td class="px-6 py-3"></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-6 py-3"></td>
                <td class="px-6 py-3"></td>
                <td class="px-6 py-3"></td>
                <td class="px-6 py-3">

                </td>
                <td class="px-6 py-3">
                    
                </td>
                <td class="px-6 py-3 text-right">
                    
                </td>
            </tr>

        </tbody>
    </table>
</div>


@endsection