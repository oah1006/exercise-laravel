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
            {{-- Search roles --}}
            <div class="w-[33.3333%]">
                <p class="text-base font-medium text-zinc-700">Search for Role</p>
                <select name="role_id" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" value="{{ request()->role_id }}">
                    <option value="0">All roles</option>   
                    @if (! empty($allRoles)) 
                        @foreach ($allRoles as $role)
                            <option value="{{ $role->id }}" {{ request()->role_id == $role->id ? 'selected' : false }}>{{ $role->role }}</option>"
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
        <div class="w-1/4 px-6 pb-3 flex items-center gap-3">
            <button type="submit" class="px-3 py-2 bg-blue-500 rounded-md text-white mt-4">Search now</button>
            <a href="{{ route('users.index') }}" class="border border-zinc-300 px-3 py-2 rounded-md mt-4 hover:border-zinc-500 hover:bg-zinc-100">Reset Search</a>
        </div>
    </form>

    <div class="relative overflow-x-auto shadow-md rounded-lg mx-8">
        <table class="w-full text-sm text-left bg-white rounded-lg">
            <thead class="font-medium text-gray-800 uppercase bg-zinc-200 rounded-lg">
                <tr>
                    <td class="px-6 py-3">STT</td>
                    <td class="px-6 py-3 hover:text-red-500">
                        <a href="?sort-by=name&sort-type={{ $sortType }}">Name</a>
                        
                    </td>
                    <td class="px-6 py-3 hover:text-red-500">
                        <a href="?sort-by=email&sort-type={{ $sortType }}">email</a>
                    </td>
                    <td class="px-6 py-3"">Role</th>
                    <td class="px-6 py-3">State</td>
                    <td class="px-6 py-3"></td>
                </tr>
            </thead>
            <tbody>
                @if (!empty($usersList))   
                    @foreach($usersList as $key => $user)
                        <tr>
                            <td class="px-6 py-3">{{ $key + 1 }}</td>
                            <td class="px-6 py-3">{{ $user->name}}</td>
                            <td class="px-6 py-3">{{ $user->email}}</td>
                            <td class="px-6 py-3">
                        
                                @if ($user->role_id == 2) 
                                    {!! '<p class="text-center font-medium w-28 py-0 bg-red-500 text-white rounded-md">Administrator</p>' !!}
                                @elseif ($user->role_id == 3)
                                    {!! '<p class="text-center font-medium w-28 py-0 bg-green-600 text-white rounded-md">Manager</p>' !!}
                                @else
                                    {!! '<p class="text-center font-medium w-28 py-0 bg-blue-500 text-white rounded-md">User</p>' !!}
                                @endif
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

        <div class="px-2 py-2">
            {{ $usersList->links()  }}
        </div>
    </div>


    





@endsection