<div class="flex">
    <div class="bg-gray-900 w-80 border-none py-2">
        <h1 class="text-white px-20  text-3xl font-bold">Deverhub</h1>
    </div>
    <div class="grow py-2 flex items-center border-b">
        @auth
            <div class="ml-auto flex gap-4 items-center px-4">
                <a href="{{ route('auth.login') }}" class="text-blue-500 font-medium">{{ auth()->user()->name }}</a>
                <a href="{{ route('auth.logout') }}" class="px-4 py-1 bg-red-500 text-white rounded-md">logout</a>
            </div>
        @endauth

        @guest
            <div class="ml-auto flex gap-4 items-center px-4">
                <a href="{{ route('auth.login') }}" class="px-4 py-1 bg-blue-500 text-white rounded-md">Login</a>
                <a href="{{ route('auth.register') }}" class="px-4 py-1 bg-red-500 text-white rounded-md">Register</a>
            </div>
        @endguest
        
    </div>
</div>
