<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Document</title>
</head>
<body>
    @include('layouts.header')
    <div>
        <div class="flex">
            <div>
                @section('layouts.sidebar')
                    @include('layouts.sidebar')
                @show
            </div>
            <div class="grow bg-zinc-100">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>