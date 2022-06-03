@extends('layouts.master')

@section('content')

    <div class="flex items-center px-8 py-6">
        <p class="text-4xl font-light">{{ $title }}</p>
        <a href="{{ route('users.add') }}" class="ml-auto px-3 py-2 bg-blue-500 rounded-lg text-white h-full">Create new</a>
    </div>

    <form action="" method="POST" class="mx-8 mb-6 bg-white rounded-lg">
        <div class="flex items-center gap-8 px-6 py-3">
            <div class="w-[33.3333%]">
                <p class="text-base font-medium text-zinc-700">Search for keywords</p>
                <input type="search" class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Key search ...">
            </div>
            <div class="w-[33.3333%]">
                <p class="text-base font-medium text-zinc-700">Search for groups</p>
                <select name="" class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2">
                    <option value="0">All groups</option>
                </select>
            </div>
            <div class="w-[33.3333%]">
                <p class="text-base font-medium text-zinc-700">Search for status</p>
                <select name="" class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2">
                    <option value="0">All state</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        <div class="w-1/4 px-6 pb-3">
            <button type="submit" class="px-3 py-2 bg-blue-500 rounded-md text-white mt-4">Search now</button>
        </div>
    </form>

    <div class="relative overflow-x-auto shadow-md rounded-lg mx-8">
        <table class="w-full text-sm text-left bg-white rounded-lg">
            <thead class="font-medium text-gray-800 uppercase bg-zinc-200 rounded-lg">
                <tr>
                    <td class="px-6 py-3">STT</td>
                    <td class="px-6 py-3">Name</td>
                    <td class="px-6 py-3">Email</td>
                    <td class="px-6 py-3"">Group</th>
                    <td class="px-6 py-3">State</td>
                    <td class="px-6 py-3"></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-6 py-3">1</td>
                    <td class="px-6 py-3">Hào Tommy</td>
                    <td class="px-6 py-3">bnhao10062001@gmail.com</td>
                    <td class="px-6 py-3">
                        <p class="text-center font-medium w-20 py-0 bg-red-500 text-white rounded-md">Manager</p>
                    </td>
                    <td class="px-6 py-3">
                        <p class="text-center font-medium w-20 py-0 bg-teal-400 text-white rounded-md">Active</p>
                    </td>
                    <td class="px-6 py-3 text-right">
                        <button href="#" class="px-3 py-2 bg-zinc-200 rounded-md">Quản lý</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    





@endsection