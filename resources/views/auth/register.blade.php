@extends('layouts.blank')

@section('content')

    <div class="border border-zinc-300 w-1/3 mt-20 rounded-lg">
        <p class="bg-zinc-700 text-center py-4 font-bold text-3xl border-b shadow text-white rounded-t-lg rounded-b-null">{{ $title }}</p>
        <form action="{{ route('auth.create') }}" method="POST" class="px-4 py-4">
            <div>
                <p>Full name</p>
                <input type="text" name="name" placeholder="Fullname..." class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" value="{{ old('username') }}">
                @error('fullname')
                    <p class="text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <p>Username</p>
                <input type="text" name="username" placeholder="Username..." class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" value="{{ old('username') }}">
                @error('username')
                    <p class="text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <p>Email</p>
                <input type="text" name="email" placeholder="Email..." class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <p>Password</p>
                <input type="password" name="password" placeholder="Password..." class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2">
                @error('password')
                    <p class="text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <p>Password Confirmation</p>
                <input type="password" name="password_confirmation" placeholder="Password Confirmation..." class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2">
                @error('password_confirmation')
                    <p class="text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex mt-6">
                <button type="submit" class="ml-auto w-full py-2 bg-blue-600 rounded-lg text-white font-medium text-lg">Register</button>
            </div>
            @csrf
        </form>
    </div>

@endsection