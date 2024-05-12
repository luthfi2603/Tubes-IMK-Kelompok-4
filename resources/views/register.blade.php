<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

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
                            class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="no-telepon"
                            placeholder="Nama lengkap"/>
                    </div>
                    <div class="content-center mt-5">
                        <label class="ml-2 text-sm font-bold text-gray-700 tracking-wide">No Telepon</label>
                        <input
                            class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="no-telepon"
                            placeholder="+62"/>
                    </div>
                    <div class="content-center mt-5 relative">
                        <label class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Password</label>
                        <input
                            class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="password"
                            placeholder="Password"/>
                            <i class="fa-solid fa-eye absolute right-3 top-10 cursor-pointer" style="color: #222c67;" id="togglePassword"></i>
                    </div>
                    <div class="content-center mt-5 relative">
                        <label class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Password</label>
                        <input
                            class="w-full px-5 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            type="confirm-password"
                            placeholder="Confirm Password"/>
                            <i class="fa-solid fa-eye absolute right-3 top-10 cursor-pointer" style="color: #222c67;" id="togglePassword"></i>
                    </div>
                  <button
                    class="mt-5 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span class="ml-3">
                      Sign In
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


    {{-- punya lutpi --}}
    {{-- <div class="flex flex-col items-center">
        @if(session()->has('failed'))
            <div class="mt-4 bg-red-300 py-3 text-white px-9 rounded-lg">
                {{ session('failed') }}
            </div>
        @endif
        <p class="my-4 font-semibold text-xl">Registrasi</p>
        <form method="POST" action="{{ route('register') }}" class="w-9/12 md:w-1/4 flex flex-col items-center">
            @csrf
            <div class="flex flex-col mb-3 w-full">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="@error('nama') bg-red-500 placeholder-white @enderror" placeholder="John Doe" value="{{ old('nama') }}" autofocus>
                @error('nama')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col mb-3 w-full">
                <label for="nomor_handphone">Nomor Handphone</label>
                <input type="number" pattern="^\d+$" name="nomor_handphone" id="nomor_handphone" class="@error('nomor_handphone') bg-red-500 placeholder-white @enderror" placeholder="08XXXXXXXX" value="{{ old('nomor_handphone') }}">
                @error('nomor_handphone')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col mb-3 w-full">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="@error('alamat') bg-red-500 placeholder-white @enderror" placeholder="Jalan Makmur" value="{{ old('alamat') }}">
                @error('alamat')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col mb-3 w-full">
                <label for="alamat">Jenis Kelamin</label>
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
                        <div style="color: #dc3545; font-size: 90%">
                            {{ $message }}
                        </div>
                    @enderror
                @endif
            </div>
            <div class="flex flex-col mb-3 w-full">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="@error('tanggal_lahir') bg-red-500 placeholder-white @enderror" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col mb-3 w-full">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="@error('pekerjaan') bg-red-500 placeholder-white @enderror" placeholder="Pekerjaan" value="{{ old('pekerjaan') }}">
                @error('pekerjaan')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col mb-3 w-full">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="@error('password') bg-red-500 placeholder-white @enderror" placeholder="Password">
                @error('password')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col mb-3 w-full">
                <label for="konfirmasi_password">Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="@error('konfirmasi_password') bg-red-500 placeholder-white @enderror" placeholder="Konfirmasi Password">
                @error('konfirmasi_password')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-400 rounded-xl text-white mb-4 mt-1">Daftar</button>
            <p class="mb-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500">Login</a></p>
        </form>
    </div> --}}
</body>
</html>