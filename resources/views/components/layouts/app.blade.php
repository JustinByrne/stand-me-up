<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="grid w-screen h-screen bg-zinc-200 place-content-center">
        <div class="p-6 mx-auto bg-white rounded w-[750px]">
            {{ $slot }}
        </div>
    </body>
</html>
