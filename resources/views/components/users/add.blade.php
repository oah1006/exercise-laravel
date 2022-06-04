@extends('layouts.master')

@section('content')

    <div class="flex justify-center mt-4 content-center">
        <form action="" method="POST" class="mx-8 mb-6 bg-white rounded-lg w-1/2">
            <p class="text-4xl font-light px-8 py-6 text-center">{{ $title }}</p>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">Invalid Data Input! Please try again.</div>
            @endif
            <div class="px-6 py-3">
                <p class="text-base font-medium text-zinc-700">Fullname</p>
                <input type="text" name="fullname" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Fullname...">
                @error('fullname')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 pb-3">
                <p class="text-base font-medium text-zinc-700">Email</p>
                <input type="text" name="email" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Email...">
                @error('email')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 pb-3">
                <p class="text-base font-medium text-zinc-700">Position</p>
                <select class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" name="group_id">
                    <option value="1">Administrator</option>
                    <option value="2">Manager</option>
                </select>
            </div>
            <div class="px-6 pb-3">
                <p class="text-base font-medium text-zinc-700">Position</p>
                <select class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" name="state">
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                </select>
            </div>
            <div class="px-6 py-6 text-right">
                <button type="submit" class="ml-auto px-3 py-2 bg-blue-500 rounded-lg text-white h-full">Create new</button>
                <a href="{{ route('users.index') }}" class="ml-auto px-3 py-2 bg-yellow-400 rounded-lg h-full">Come back</a>
            </div>
            @csrf
        </form>
    </div>

@endsection