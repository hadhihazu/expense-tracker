<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="apple-touch-icon" sizes="180x180" href="/favico/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favico/favicon-16x16.png">
        <link rel="manifest" href="/favico/site.webmanifest">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
    </body>
</html>
