<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <div class="mt-12 flex flex-col items-center">
                @if(session()->has('success'))
                    <div class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg w-full md:w-80">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('failed'))
                    <div class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg w-full max-w-xs">
                        {{ session('failed') }}
                    </div>
                @endif
                <div id="success" class="hidden mb-4 bg-green-300 py-3 text-white px-4 rounded-lg md:w-80"></div>
                <h2 class="text-3xl font-bold text-[#222C67]">
                    Selamat Datang
                </h2>
                <p class="mt-2 text-sm text-gray-500">Silahkan masuk ke akun anda</p>
                <div class="w-full flex-1 mt-8">
                    <div class="mx-auto max-w-xs">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="content-center">
                                <label for="nomor_handphone" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">No Handphone</label>
                                <input
                                    class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white @error('nomor_handphone') @enderror"
                                    value="{{ old('nomor_handphone') }}" type="number" name="nomor_handphone"
                                    id="nomor_handphone" placeholder="Contoh: 081234567890" autofocus>
                                @error('nomor_handphone')
                                    <div class="text-[#B42223] text-bold text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="content-center mt-5 relative">
                                <label for="password"
                                    class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Kata Sandi</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white @error('password')  @enderror"
                                    value="{{ old('password') }}" placeholder="Masukkan kata sandi anda">
                                <i class="fas fa-eye absolute right-3 top-10 cursor-pointer" id="toggle-password"></i>
                                @error('password')
                                    <div class="text-[#B42223] text-bold text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="remember_me" class="inline-flex items-center mt-2">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ms-2 text-sm text-indigo-400 hover:text-blue-500">Ingat Saya</span>
                            </label>
                            <button class="mt-2 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <span class="ml-3">
                                    Masuk
                                </span>
                            </button>
                            <div class="mt-4 text-sm flex flex-col items-center">
                                <a href="{{ route('verifikasi.nomor.handphone') }}"
                                    class="text-indigo-400 hover:text-blue-500 mt-2">
                                    Lupa kata sandi
                                </a>
                                <span class="block mt-2">
                                    <a href="{{ route('register') }}" class="text-indigo-400 hover:text-blue-500">
                                        <i class="fa-solid fa-right-to-bracket"></i> Tidak memiliki akun?
                                    </a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-[#E3EBF3] hidden lg:flex items-center justify-center">
            <div class="m-12 xl:m-16 w-full h-full flex items-center justify-center">
                <img src="{{ asset('assets/img/picture-login.png') }}" alt="">
            </div>
        </div>
    </div>
    <script>
        const successMessage = localStorage.getItem('successMessage');
        if(successMessage){
            document.getElementById('success').classList.remove('hidden');
            document.getElementById('success').innerHTML = successMessage

            localStorage.removeItem('successMessage');
        }
    </script>
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
</body>
</html>