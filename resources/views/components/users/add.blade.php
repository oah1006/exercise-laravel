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
                <input type="text" name="name" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Fullname...">
                @error('fullname')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 py-3">
                <p class="text-base font-medium text-zinc-700">Username</p>
                <input type="text" name="username" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Username...">
                @error('username')
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
                <p class="text-base font-medium text-zinc-700">Role</p>
                <select class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" name="role_id">
                    <option>Select Role</option>
                    @if (!empty($allRoles))
                        @foreach ($allRoles as $role)
                            <option value="{{ $role->id }}" {{old('role_id') == $role->id ? "selected" : false}}>{{ $role->role }}</option>
                        @endforeach
                    @endif  
                </select>
                @error('role_id')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 pb-3">
                <p class="text-base font-medium text-zinc-700">Role</p>
                <select class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" name="state">
                    <option value="0" {{ old('state') == 0 ? 'selected' : false}}>Inactive</option>
                    <option value="1" {{ old('state') == 1 ? 'selected' : false}}>Active</option>
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