<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="shortcut icon" href="{{ asset('./assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <div class="mt-12 flex flex-col items-center">
                <h2 class="text-3xl font-bold text-[#222C67]">
                    Selamat Datang
                </h2>
                <p class="mt-2 text-sm text-gray-500">Silahkan daftarkan akun anda</p>
                <div class="w-full flex-1 mt-8">
                    <div class="mx-auto max-w-xs">
                        <div class="content-center">
                            <label class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Nama Lengkap</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="text" placeholder="Nama lengkap" autofocus/>
                        </div>
                        <div class="content-center mt-5">
                            <label class="ml-2 text-sm font-bold text-gray-700 tracking-wide">No Telepon</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="number" placeholder="Contoh: 081234567890" />
                        </div>
                        <div class="content-center mt-5 relative">
                            <label class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Password</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="password" placeholder="Password" />
                            <i class="fa-solid fa-eye absolute right-3 top-10 cursor-pointer" style="color: #222c67;"
                                id="togglePassword"></i>
                        </div>
                        <div class="content-center mt-5 relative">
                            <label class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Password</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="confirm-password" placeholder="Konfirm Password" />
                            <i class="fa-solid fa-eye absolute right-3 top-10 cursor-pointer" style="color: #222c67;"
                                id="togglePassword"></i>
                        </div>
                        <button
                            class="mt-5 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span class="ml-3">
                                Daftar
                            </span>
                        </button>
                        <p class="mt-6 text-sm text-center">
                            <span class="block mt-2">
                                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-blue-500">
                                    <i class="fa-solid fa-right-to-bracket"></i> Sudah memiliki akun?
                                </a>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-[#E3EBF3] hidden lg:flex">
            <div class="m-12 xl:m-16 w-full h-full bg-contain bg-center bg-no-repeat flex items-center justify-center">
                <img src="{{ asset('assets/img/picture-login.png') }}" alt="">
            </div>
        </div>
    </div>
</body>

</html>