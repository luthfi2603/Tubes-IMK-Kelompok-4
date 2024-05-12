@extends('layouts.main')

@section('container')
<div class="flex flex-col gap-4">
    <p class="text-2xl md:text-3xl font-bold">Profil</p>
    <form method="POST" action="{{ route('register') }}" class="flex flex-col items-center">
        @csrf
        <div class="flex flex-col items-center mb-3 w-full gap-4">
            <svg class="w-2/5 h-2/5 border-2" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
            <img src="{{ asset('assets/img/test.png') }}" alt="foto-profil" class="w-1/3 h-1/3 border-2 rounded-full">
            <button class="border-2 rounded-lg border-[#8E8D8B] text-[#8E8D8B] font-semibold px-3 py-1">Pilih Foto</button>
        </div>
        <div class="flex flex-col mb-3 w-full">
            <label class="font-semibold" for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="rounded-lg @error('nama') bg-red-500 placeholder-white @enderror" placeholder="John Doe" value="{{ old('nama') }}">
            @error('nama')
                <div class="bg-red-300 text-white">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col mb-3 w-full">
            <label class="font-semibold" for="nomor_handphone">Nomor Handphone</label>
            <input type="number" pattern="^\d+$" name="nomor_handphone" id="nomor_handphone" class="rounded-lg @error('nomor_handphone') bg-red-500 placeholder-white @enderror" placeholder="08XXXXXXXX" value="{{ old('nomor_handphone') }}">
            @error('nomor_handphone')
                <div class="bg-red-300 text-white">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col mb-3 w-full">
            <label class="font-semibold" for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="rounded-lg @error('alamat') bg-red-500 placeholder-white @enderror" placeholder="Jalan Makmur" value="{{ old('alamat') }}">
            @error('alamat')
                <div class="bg-red-300 text-white">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col mb-3 w-full">
            <label class="font-semibold" for="alamat">Jenis Kelamin</label>
            @if(old('jenis_kelamin') == 'P')
                <div>
                    <input type="radio" id="L" name="jenis_kelamin" value="L">
                    <label class="font-semibold" class="mr-2" for="L">Laki-laki</label>
                    <input type="radio" id="P" name="jenis_kelamin" value="P" checked>
                    <label class="font-semibold" class="label" for="P">Perempuan</label>
                </div>
            @elseif(old('jenis_kelamin') == 'L')
                <div>
                    <input type="radio" id="L" name="jenis_kelamin" value="L" checked>
                    <label class="font-semibold" class="mr-2" for="L">Laki-laki</label>
                    <input type="radio" id="P" name="jenis_kelamin" value="P">
                    <label class="font-semibold" class="label" for="P">Perempuan</label>
                </div>
            @else
                <div>
                    <input type="radio" id="L" name="jenis_kelamin" value="L">
                    <label class="font-semibold" class="mr-2" for="L">Laki-laki</label>
                    <input type="radio" id="P" name="jenis_kelamin" value="P">
                    <label class="font-semibold" class="label" for="P">Perempuan</label>
                </div>
                @error('jenis_kelamin')
                    <div style="color: #dc3545; font-size: 90%">
                        {{ $message }}
                    </div>
                @enderror
            @endif
        </div>
        <div class="flex flex-col mb-3 w-full">
            <label class="font-semibold" for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="rounded-lg @error('tanggal_lahir') bg-red-500 placeholder-white @enderror" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
            @error('tanggal_lahir')
                <div class="bg-red-300 text-white">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col mb-4 w-full">
            <label class="font-semibold" for="pekerjaan">Pekerjaan</label>
            <input type="text" name="pekerjaan" id="pekerjaan" class="rounded-lg @error('pekerjaan') bg-red-500 placeholder-white @enderror" placeholder="Pekerjaan" value="{{ old('pekerjaan') }}">
            @error('pekerjaan')
                <div class="bg-red-300 text-white">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="border-2 rounded-lg border-[#222C67] text-[#222C67] dark:text-white dark:bg-[#222C67] font-semibold px-3 py-1">Ubah</button>
    </form>
</div>
@endsection