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
    <div class="flex flex-col items-center">
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
    </div>
    <script>
        const successMessage = localStorage.getItem('successMessage');
        if(successMessage){
            document.getElementById('success').classList.remove('hidden');
            document.getElementById('success').innerHTML = successMessage

            localStorage.removeItem('successMessage');
        }
    </script>
</body>
</html>