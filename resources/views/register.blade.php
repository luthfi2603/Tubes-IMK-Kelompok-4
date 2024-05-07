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
                <input type="number" name="nomor_handphone" id="nomor_handphone" class="@error('nomor_handphone') bg-red-500 placeholder-white @enderror" placeholder="08XXXXXXXX" value="{{ old('nomor_handphone') }}">
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
        </form>
    </div>
</body>
</html>