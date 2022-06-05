@extends('layouts.master')

@section('content')

    <div class="flex justify-center mt-4 content-center">
        <form action="{{ route('users.update') }}" method="POST" class="mx-8 mb-6 bg-white rounded-lg w-1/2">
            <div class="flex mr-6 mt-4 ">
                <a onclick="return confirm('Are you sure you want to delete this user?')" href="{{ route('users.delete', ['id' => $idUser->id]) }}" 
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
                <div class="bg-blue-200 border border-blue-400 text-black px-4 py-3 rounded my-3">{{ session('msg') }}</div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-200 text-red-600 px-4 py-3 roundedr">Invalid Data Input! Please try again.</div>
            @endif

            <div class="px-6 py-3">
                <p class="text-base font-medium text-zinc-700">Fullname</p>
                <input type="text" name="fullname" 
                class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Fullname..." value="{{ old('fullname') ?? $users->fullname}}"/>
                @error('fullname')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 pb-3">
                <p class="text-base font-medium text-zinc-700">Email</p>
                <input type="text" name="email" class="border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" placeholder="Email..." value="{{ old('email') ?? $users->email}}"/>
                @error('email')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 pb-3">
                <p class="text-base font-medium text-zinc-700">Position</p>
                <select class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" name="group_id">
                    <option>Select Group</option>
                    @if (!empty($allGroups))
                        @foreach ($allGroups as $group)
                            <option value="{{ $group->id }}" {{old('group_id') == $group->id || $users->group_id == $group->id ? "selected" : false}}>{{ $group->position }}</option>
                        @endforeach
                    @endif  
                </select>
                @error('group_id')
                    <span class="text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 pb-3">
                <p class="text-base font-medium text-zinc-700">Position</p>
                <select class="form-control border border-zinc-300 w-full py-2 rounded-2xl px-4 mt-2" name="state">
                    <option value="0" {{ old('state') == 0 || $users->state == 0 ? 'selected' : false}}>Inactive</option>
                    <option value="1" {{ old('state') == 1 || $users->state == 1 ? 'selected' : false}}>Active</option>
                </select>
            </div>
            <div class="px-6 py-6 text-right">
                <button type="submit" class="ml-auto px-3 py-2 bg-blue-500 rounded-lg text-white h-full">Update new</button>
                <a href="{{ route('users.index') }}" class="ml-auto px-3 py-2 bg-yellow-400 rounded-lg h-full">Come back</a>
            </div>
            @csrf
        </form>
    </div>

@endsection