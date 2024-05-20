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
                @if(session()->has('failed'))
                    <div class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg md:w-80">
                        {{ session('failed') }}
                    </div>
                @endif
                <h2 class="text-3xl font-bold text-[#222C67]">
                    Selamat Datang
                </h2>
                <p class="mt-2 text-sm text-gray-500">Silahkan daftarkan akun anda</p>
                <div class="w-full flex-1 mt-8">
                    <form method="POST" action="{{ route('register') }}" class="mx-auto max-w-xs">
                        @csrf
                        <div class="content-center">
                            <label for="nama" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Nama Lengkap</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                name="nama" id="nama" type="text" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" autofocus>
                            @error('nama')
                                <div class="text-[#B42223] text-bold text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="content-center mt-5">
                            <label for="nomor_handphone" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">No Handphone</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                name="nomor_handphone" id="nomor_handphone" value="{{ old('nomor_handphone') }}" type="number" placeholder="Contoh: 081234567890">
                            @error('nomor_handphone')
                                <div class="text-[#B42223] text-bold text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="content-center mt-5">
                            <label for="alamat" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Alamat</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                name="alamat" id="alamat" value="{{ old('alamat') }}" type="text" placeholder="Masukkan alamat">
                            @error('alamat')
                                <div class="text-[#B42223] text-bold text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="content-center mt-5">
                            <label class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Jenis Kelamin</label>
                            @if(old('jenis_kelamin') == 'P')
                                <div>
                                    <input type="radio" id="L" name="jenis_kelamin" value="L">
                                    <label class="mr-2" for="L">Laki-laki</label>
                                    <input type="radio" id="P" name="jenis_kelamin" value="P" checked>
                                    <label class="label" for="P">Perempuan</label>
                                </div>
                            @elseif(old('jenis_kelamin') == 'L')
                                <div>
                                    <input type="radio" id="L" name="jenis_kelamin" value="L" checked>
                                    <label class="mr-2" for="L">Laki-laki</label>
                                    <input type="radio" id="P" name="jenis_kelamin" value="P">
                                    <label class="label" for="P">Perempuan</label>
                                </div>
                            @else
                                <div>
                                    <input type="radio" id="L" name="jenis_kelamin" value="L">
                                    <label class="mr-2" for="L">Laki-laki</label>
                                    <input type="radio" id="P" name="jenis_kelamin" value="P">
                                    <label class="label" for="P">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="text-[#B42223] text-bold text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endif
                        </div>
                        <div class="content-center mt-5">
                            <label for="tanggal_lahir" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Tanggal Lahir</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <div class="text-[#B42223] text-bold text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="content-center mt-5">
                            <label for="pekerjaan" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Pekerjaan</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" type="text" placeholder="Masukkan pekerjaan">
                            @error('pekerjaan')
                                <div class="text-[#B42223] text-bold text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="content-center mt-5 relative">
                            <label for="password" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Kata Sandi</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                name="password" id="password" type="password" placeholder="Masukkan kata sandi">
                            <i class="fa-solid fa-eye absolute right-3 top-10 cursor-pointer" style="color: #222c67;" id="toggle-password"></i>
                            @error('password')
                                <div class="text-[#B42223] text-bold text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="content-center mt-5 relative">
                            <label for="konfirmasi_password" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Konfirmasi Kata Sandi</label>
                            <input
                                class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                name="konfirmasi_password" id="konfirmasi_password" type="password" placeholder="Masukkan konfirmasi kata sandi">
                            <i class="fa-solid fa-eye absolute right-3 top-10 cursor-pointer" style="color: #222c67;" id="toggle-password-2"></i>
                            @error('konfirmasi_password')
                                <div class="text-[#B42223] text-bold text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button
                            class="mt-7 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
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
                    </form>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-[#E3EBF3] hidden lg:flex items-center justify-center">
            <div class="m-12 xl:m-16 w-full h-full flex items-center justify-center">
                <img src="{{ asset('assets/img/picture-login.png') }}" alt="">
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
</body>
</html>