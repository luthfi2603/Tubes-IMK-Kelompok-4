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
    <style>
        body {
            background: linear-gradient(135deg, #E0E7FF 0%, #EBF2FF 100%);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center items-center">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="w-full p-6 sm:p-12">
            <div class=" flex flex-col items-center">
                @if(session()->has('failed'))
                    <div class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
                        <i class="fa-solid fa-circle-exclamation mr-1"></i>
                        <span>{{ session('failed') }}</span>
                    </div>
                @endif
                <img src="{{ asset('assets/img/logo.png') }}" class="w-28 h-28" alt="">
                <h2 class="text-3xl font-bold my-2 text-[#222C67]">
                    Selamat Datang
                </h2>
                <p class=" text-md text-gray-500 mt-1 mb-2">Silahkan daftarkan akun anda</p>
                <div class="w-full flex-1 mt-8 max-w-4xl">
                    <form method="POST" action="{{ route('register') }}" class="mx-auto">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                            <div class="form-group relative">
                                <label for="nama" class="block text-md font-bold text-gray-700 tracking-wide">Nama Lengkap</label>
                                <input
                                    class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                                    name="nama" id="nama" type="text" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" autofocus>
                                @error('nama')
                                 <div class="text-[#B42223] text-bold text-md px-1 py-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group relative">
                                <label for="nomor_handphone" class="block text-md font-bold text-gray-700 tracking-wide">No Handphone</label>
                                <input
                                    class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                                    name="nomor_handphone" id="nomor_handphone" value="{{ old('nomor_handphone') }}" type="number" placeholder="Contoh: 081234567890">
                                @error('nomor_handphone')
                                 <div class="text-[#B42223] text-bold text-md px-1 py-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group relative">
                                <label for="alamat" class="block text-md font-bold text-gray-700 tracking-wide">Alamat</label>
                                <input
                                    class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                                    name="alamat" id="alamat" value="{{ old('alamat') }}" type="text" placeholder="Masukkan alamat">
                                @error('alamat')
                                 <div class="text-[#B42223] text-bold text-md px-1 py-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group relative">
                                <label class="block text-md font-bold text-gray-700 tracking-wide">Jenis Kelamin</label>
                                <div class="mt-3">
                                    <input type="radio" id="L" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                    <label class="mr-2" for="L">Laki-laki</label>
                                    <input type="radio" id="P" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                    <label class="label" for="P">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                 <div class="text-[#B42223] text-bold text-md px-1 py-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group relative">
                                <label for="tanggal_lahir" class="block text-md font-bold text-gray-700 tracking-wide">Tanggal Lahir</label>
                                <input
                                    class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                                    type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                 <div class="text-[#B42223] text-bold text-md px-1 py-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group relative">
                                <label for="pekerjaan" class="block text-md font-bold text-gray-700 tracking-wide">Pekerjaan</label>
                                <input
                                    class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                                    name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" type="text" placeholder="Masukkan pekerjaan">
                                @error('pekerjaan')
                                 <div class="text-[#B42223] text-bold text-md px-1 py-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group relative">
                                <label for="password" class="block text-md font-bold text-gray-700 tracking-wide">Kata Sandi</label>
                                <div class="relative">
                                    <input
                                        class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                                        name="password" id="password" type="password" placeholder="Masukkan kata sandi">
                                    <i class="fa-solid fa-eye absolute right-3 top-4 cursor-pointer" id="toggle-password"></i>
                                </div>
                                @error('password')
                                 <div class="text-[#B42223] text-bold text-md px-1 py-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group relative">
                                <label for="konfirmasi_password" class="block text-md font-bold text-gray-700 tracking-wide">Konfirmasi Kata Sandi</label>
                                <div class="relative">
                                    <input
                                        class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                                        name="konfirmasi_password" id="konfirmasi_password" type="password" placeholder="Masukkan konfirmasi kata sandi">
                                    <i class="fa-solid fa-eye absolute right-3 top-4 cursor-pointer" id="toggle-password-2"></i>
                                </div>
                                @error('konfirmasi_password')
                                 <div class="text-[#B42223] text-bold text-md px-1 py-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-7 flex justify-center">
                            <button
                                class="tracking-wide font-semibold bg-[#374280] text-gray-100 w-48 py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <span class="ml-3">
                                    Daftar
                                </span>
                            </button>
                        </div>
                        <p class="mt-6 text-md text-center">
                            <span class="block mt-2">
                                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-blue-500">
                                    <i class="fa-solid fa-right-to-bracket"></i> Sudah memiliki akun?
                                </a>
                            </span>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
</body>
</html>
