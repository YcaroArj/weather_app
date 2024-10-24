<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    @vite('resources/css/app.css')
    <title>Weather App</title>
</head>

<body>
    <main class="h-full bg-gray-900 p-12 flex flex-col items-center">
        <form class="w-[50%] max-md:w-full" action="{{ route('post.weather') }}" method="POST">
            @csrf
            <input type="search" name="city"
                class="rounded px-5 bg-gray-700 h-[40px] w-full focus:outline-none placeholder-white text-white"
                placeholder="Buscar cidade...">
        </form>
        <div class="flex flex-row justify-center mt-10">
            @yield('content')
        </div>
    </main>
</body>

</html>
