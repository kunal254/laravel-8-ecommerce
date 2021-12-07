<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <title>Beyond</title>
</head>
<body>
    <main>
        <div>
            <a id="logo" href="/">
                <img src="{{ asset('img/b.png') }}" alt="logo">
            </a>
        </div>

        <div class="card">
            {{ $slot }}
        </div>
    </main>
</body>
</html>