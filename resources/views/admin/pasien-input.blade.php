@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] dark:bg-green-900 text-[#0f5132] dark:text-green-300 border-2 border-[#badbcc] dark:border-green-700 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] dark:bg-red-900 text-[#842029] dark:text-red-300 border-2 border-[#f5c2c7] dark:border-red-700 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto bg-white dark:bg-gray-900 dark:border-gray-700 p-8 rounded-lg shadow-lg border border-gray-300">
        <div class="flex items-center mb-6">
            <img src="{{ asset('assets/img/pasien-input.png') }}" class="w-24 h-24" alt="Tambah Pasien">
            <div class="ml-4">
                <h1 class="text-2xl md:text-3xl font-bold dark:text-white">Tambah Pasien</h1>
                <p class="text-gray-500 text-md dark:text-gray-300">Silahkan lengkapi formulir di bawah ini untuk menambahkan pasien baru ke sistem.</p>
            </div>
        </div>
        <form action="{{ route('admin.tambah.pasien') }}" method="POST" class="space-y-4">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('nama') }}">
                @error('nama')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="nomor_handphone" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Nomor Handphone</label>
                <input type="number" name="nomor_handphone" id="nomor_handphone" class="w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('nomor_handphone', $nomorHandphone) }}">
                @error('nomor_handphone')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('alamat') }}">
                @error('alamat')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="pekerjaan" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('pekerjaan') }}">
                @error('pekerjaan')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <p class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Jenis Kelamin</p>
                <div class="flex items-center">
                    <input type="radio" id="L" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} class="mr-2">
                    <label for="L" class="mr-4">Laki-laki</label>
                    <input type="radio" id="P" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="mr-2">
                    <label for="P">Perempuan</label>
                </div>
                @error('jenis_kelamin')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-end">
                <button class="mr-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1"><i class="fa-solid fa-floppy-disk mr-2"></i>Tambah</button>
                <a href="{{ route('admin.data.pasien') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection