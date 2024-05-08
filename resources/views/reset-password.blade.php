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
        @endif
        <p class="my-4 font-semibold text-xl">Input Password Baru</p>
        <form method="POST" action="{{ route('reset.password') }}" class="w-9/12 md:w-1/4 flex flex-col items-center">
            @csrf
            <div class="flex flex-col mb-3 w-full">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="@error('password') bg-red-500 placeholder-white @enderror" placeholder="Masukkan password baru anda" autofocus>
                @error('password')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
                <label for="konfirmasi_password">Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="@error('konfirmasi_password') bg-red-500 placeholder-white @enderror" placeholder="Masukkan konfirmasi password baru anda">
                @error('konfirmasi_password')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-400 rounded-xl text-white mb-4 mt-1">Kirim</button>
        </form>
    </div>
</body>
</html>