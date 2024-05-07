<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}">
</head>
<body>
    <div class="flex flex-col items-center bg-blue-400 text-white h-screen justify-center">
        <p class="text-4xl">Landing Page</p>
        <div class="mt-4">
            <a href="{{ route('register') }}" class="mr-3 rounded-xl py-1 px-6 bg-white text-blue-400">Register</a>
            <a href="{{ route('login') }}" class="rounded-xl py-1 px-6 bg-white text-blue-400">Login</a>
        </div>
    </div>
</body>
</html>