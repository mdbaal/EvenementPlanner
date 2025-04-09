<!doctype html>
<html>
    <head>
        <title>{{ $title ?? "Evenementen Wereld" }}</title>
        @vite('resources/css/app.css')
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
    </head>
    </head>
    <body>
        <x-header></x-header>
        <main class="mx-auto max-w-screen-xl shadow-xl my-3 bg-white  p-3">
            {{ $slot }}
        </main>
        <x-footer></x-footer>
    </body>
</html>
