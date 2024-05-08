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
        <p class="my-4 font-semibold text-xl">Verifikasi</p>
        <form method="POST" action="{{ route('verifikasi') }}" class="w-9/12 md:w-1/4 flex flex-col items-center">
            @csrf
            <input type="hidden" name="nomor_handphone" value="{{ session()->get('request')['nomor_handphone_dimodifikasi'] }}">
            <div class="flex flex-col mb-3 w-full">
                <label for="kode_verifikasi">Kode OTP</label>
                <input type="number" name="kode_verifikasi" id="kode_verifikasi" class="@error('kode_verifikasi') bg-red-500 placeholder-white @enderror" placeholder="Masukkan kode otp" value="{{ old('kode_verifikasi') }}" autofocus>
                @error('kode_verifikasi')
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