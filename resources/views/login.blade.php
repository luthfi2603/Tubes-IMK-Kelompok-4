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

<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1">
      <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12"> 
        
        <div class="mt-12 flex flex-col items-center">

            @if(session()->has('failed'))
            <div class="mt-4 bg-red-300 py-3 text-white px-9 rounded-lg">
                {{ session('failed') }}
            </div>
            @elseif(session()->has('success'))
                <div class="mt-4 bg-green-300 py-3 text-white px-9 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div id="success" class="mt-4 bg-green-300 py-3 text-white px-9 rounded-lg hidden"></div>

            <h2 class="text-3xl font-bold text-[#222C67]">
                Selamat Datang
            </h2>
            <p class="mt-2 text-sm text-gray-500">Silahkan masuk ke akun anda</p>
          <div class="w-full flex-1 mt-8">
        
            <div class="mx-auto max-w-xs">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="content-center">
                    <label for= "nomor_telephone" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">No Telepon</label>
                    <input
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white @error('nomor_handphone') @enderror" value="{{ old('nomor_handphone') }}"
                        type="number" name="nomor_handphone" id="nomor_handphone"
                        placeholder="+628123456789" autofocus/>
                        @error('nomor_handphone')
                        <div class="text-white text-bold text-sm" style="color: #B42223">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="content-center mt-5 relative">
                    <label for="password" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white @error('password')  @enderror" value="{{ old('password') }}"
                        type="password"
                        placeholder="Password"/>
                        <i class="fas fa-eye absolute right-3 top-10 cursor-pointer" id="togglePassword"></i>
                        @error('password')
                            <div class="text-white text-bold text-sm" style="color: #B42223">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
              <button
                class="mt-5 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span class="ml-3">
                  Sign In
                </span>
              </button>
              <p class="mt-6 text-sm text-center">
                <a href="{{ route('verifikasi.nomor.handphone') }}" class="text-indigo-400 hover:text-blue-500">
                    Lupa kata sandi
                </a>
                <span class="block mt-2">
                    <a href="{{ route('register') }}" class="text-indigo-400 hover:text-blue-500">
                        <i class="fa-solid fa-right-to-bracket"></i> Tidak memiliki akun?
                    </a>
                </span>
              </p>
             </form>
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
        @elseif(session()->has('success'))
            <div class="mt-4 bg-green-300 py-3 text-white px-9 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        <div id="success" class="mt-4 bg-green-300 py-3 text-white px-9 rounded-lg hidden"></div>
        <p class="my-4 font-semibold text-xl">Login</p>
        <form method="POST" action="{{ route('login') }}" class="w-9/12 md:w-1/4 flex flex-col items-center">
            @csrf
            <div class="flex flex-col mb-3 w-full">
                <label for="nomor_handphone">Nomor Handphone</label>
                <input type="number" name="nomor_handphone" id="nomor_handphone" class="@error('nomor_handphone') bg-red-500 placeholder-white @enderror" placeholder="Masukkan nomor handphone kamu" value="{{ old('nomor_handphone') }}" autofocus>
                @error('nomor_handphone')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col mb-3 w-full">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="@error('password') bg-red-500 placeholder-white @enderror" placeholder="Masukkan password kamu" value="{{ old('password') }}">
                @error('password')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <a href="{{ route('verifikasi.nomor.handphone') }}" class="mb-3">Lupa Password</a>
            <button type="submit" class="px-4 py-2 bg-gray-400 rounded-xl text-white mb-4 mt-1">Masuk</button>
            <p>Sudah punya akun? <a href="{{ route('register') }}" class="text-blue-500">Register</a></p>
        </form>
    </div>  --}}
    
    {{-- <script>
        const successMessage = localStorage.getItem('successMessage');
        if(successMessage){
            document.getElementById('success').classList.remove('hidden');
            document.getElementById('success').innerHTML = successMessage

            localStorage.removeItem('successMessage');
        }
    </script> --}}
</body> 
</html>