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
</head>
<body class="font-body bg-[#E3EBF3]">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="w-full flex justify-between items-center pt-6">
            <img src="http://127.0.0.1:8000/assets/img/logo.png" alt="Logo Klinik RH61" class="w-36 h-auto sm:w-24 md:w-32 lg:w-36 xl:w-36 max-[640px]:w-20">
        </div>
        <!-- Main Content -->
        <div class="relative text-center pb-12 md:pb-6">
            <h1 class="text-4xl sm:text-2xl md:text-2xl lg:text-4xl xl:text-4xl max-[640px]:text-sm font-bold text-[#0a0a0a] absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-24 max-[640px]:pt-14 sm:pt-10">
                Kelola Kesehatan Anda dan Masa Depan yang Bahagia
            </h1>
            <p class="mt-17 text-lg sm:text-md md:text-lg lg:text-xl xl:text-2xl max-[640px]:text-sm text-gray-700 max-[640px]:pt-10 sm:pt-10">
                Klinik RH61 adalah klinik kesehatan yang lebih dalam <br>
                bernaung di bidang kesehatan jantung
            </p>
        </div>
        <!-- Button Section -->
        <div class="flex justify-center">
            <a href="{{ route('masuk.sebagai') }}" class="bg-[#222C67] hover:bg-[#525985] text-[#f5f5f5] text-xl font-bold pt-3 pb-3 px-6 border-[#222C67] hover:border-[#525985] rounded-lg shadow-lg max-[640px]:text-lg max-[640px]:px-3 py-2 md:text-lg">Mulai Sekarang</a>
        </div>
        <!-- Doctors Image Section -->
        <div class="relative flex justify-center py-12">
            <div class="absolute -top-10 left-4 lg:left-10 hidden lg:block">
                <img src="http://127.0.0.1:8000/assets/img/calendar.png" alt="Calendar" class="w-36 h-auto">
            </div>
            <div class="absolute -top-10 right-4 lg:right-10 hidden lg:block">
                <img src="http://127.0.0.1:8000/assets/img/medicine.png" alt="Pills" class="w-32 h-auto">
            </div>
            <div class="absolute -bottom-10 left-4 lg:left-10 hidden lg:block">
                <img src="http://127.0.0.1:8000/assets/img/signedpng.png" alt="Clipboard" class="w-36 h-auto">
            </div>
            <div class="absolute -bottom-10 right-4 lg:right-10 hidden lg:block">
                <img src="http://127.0.0.1:8000/assets/img/cardiogram.png" alt="Heartbeat" class="w-36 h-auto">
            </div>
            <img src="http://127.0.0.1:8000/assets/img/Picture-Doctor.png" alt="Doctors" class="object-contain w-full md:w-3/4 lg:w-1/2 h-auto">
        </div>
    </div>
</body>
</html>