<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="{{ asset('assets/js/custom-check.js') }}"></script>
</head>
<body class="text-gray-800 font-body">
    @include('layouts.navbar')
        <!-- Content -->
        <div class="p-6 dark:bg-slate-800 dark:text-slate-500 transition-colors">
            @yield('container')
        </div>
        <!-- End Content -->
    </main>
    <script src="{{ asset('assets/framework/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @stack('scripts')
</body>
</html>