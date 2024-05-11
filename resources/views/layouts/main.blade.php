<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="icon" href="{{ asset('./assets/img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .-translate-x-full{
            --tw-translate-x: -100%;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }
        
        @media (min-width: 768px) {
            .main.active {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body class="text-gray-800 font-body">
    @include('layouts.navbar')
        <!-- Content -->
        <div class="p-6">
            @yield('container')
        </div>
        <!-- End Content -->
    </main>
    <script src="https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="{{ asset('./assets/js/main.js') }}"></script>
</body>
</html>