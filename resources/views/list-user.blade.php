@extends('layouts.master')

@section('content')

    <div class="flex items-center px-8 py-6">
        <p class="text-4xl font-light">{{ $title }}</p>
        <a href="{{ route('users.add') }}" class="ml-auto px-3 py-2 bg-blue-500 rounded-lg text-white h-full">Create new</a>
    </div>
    @if (session('msg'))
        <div class="bg-blue-200 border border-blue-400 text-black px-4 py-3 rounded my-3">{{ session('msg') }}</div>
    @endif

    <form action="" method="GET" class="mx-8 mb-6 bg-white rounded-lg">
        <div class="flex items-center gap-8 px-6 py-3">
            {{-- Search Keywords --}}
            <div class="w-[33.3333%]">
                <p class="text-base font-medium text-zinc-700">Search for keywords</p>
                <input type="search" name="keywords" id="keywords" 
                class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Key search ..."
                value="{{ request()->keywords }}">
            </div>
            {{-- Search Groups --}}
            <div class="w-[33.3333%]">
                <p class="text-base font-medium text-zinc-700">Search for groups</p>
                <select name="group_id" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" value="{{ request()->group_id }}">
                    <option value="0">All groups</option>   
                    @if (! empty($allGroups)) 
                        @foreach ($allGroups as $group)
                            <option value="{{ $group->id }}" {{ request()->group_id == $group->id ? 'selected' : false }}>{{ $group->position }}</option>"
                        @endforeach
                    @endif
                </select>
            </div>
            {{-- Search State --}}
            <div class="w-[33.3333%]">
                <p class="text-base font-medium text-zinc-700">Search for status</p>
                <select name="state" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" value="{{ request()->state }}">
                    <option value="0">All state</option>
                    <option value="active" {{ request()->state == 'active' ? 'selected' : false }}>Active</option>
                    <option value="inactive" {{ request()->state == 'inactive' ? 'selected' : false }}>Inactive</option>
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
                    <td class="px-6 py-3 hover:text-red-500">
                        <a href="?sort-by=fullname&sort-type={{ $sortType }}">Name</a>
                        
                    </td>
                    <td class="px-6 py-3 hover:text-red-500">
                        <a href="?sort-by=email&sort-type={{ $sortType }}">email</a>
                    </td>
                    <td class="px-6 py-3"">Group</th>
                    <td class="px-6 py-3">State</td>
                    <td class="px-6 py-3"></td>
                </tr>
            </thead>
            <tbody>
                @if (!empty($usersList))   
                    @foreach($usersList as $key => $user)
                        <tr>
                            <td class="px-6 py-3">{{ $key + 1 }}</td>
                            <td class="px-6 py-3">{{ $user->fullname}}</td>
                            <td class="px-6 py-3">{{ $user->email}}</td>
                            <td class="px-6 py-3">
                                {!! $user->group_id == 1 ? '<p class="text-center font-medium w-28 py-0 bg-red-500 text-white rounded-md"
                                >Administrator</p>'
                                : '<p class="text-center font-medium w-28 py-0 bg-green-600 text-white rounded-md">Manager</p>' !!}
                            </td>
                            <td class="px-6 py-3">
                                {!! $user->state == 0 ? 
                                '<p class="text-center font-medium w-20 py-0 bg-zinc-400 text-white rounded-md">Inactive</p>' 
                                : '<p class="text-center font-medium w-20 py-0 bg-teal-400 text-white rounded-md">Active</p>'!!}
                            </td>
                            <td class="px-6 py-3 text-right">
                                <a href="{{ route('users.update', ['id' => $user->id]) }}" class="px-3 py-2 bg-zinc-200 rounded-md">Quản lý</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td>No users</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    





@endsection