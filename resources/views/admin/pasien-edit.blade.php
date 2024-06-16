@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-300">
        <div class="flex items-center mb-6">
            <img src="{{ asset('assets/img/pasien-input.png') }}" class="w-24 h-24" alt="Tambah Pasien">
            <div class="ml-4">
                <h1 class="text-2xl md:text-3xl font-bold">Edit Pasien</h1>
                <p class="text-gray-500 text-md">Silahkan ubah formulir di bawah ini untuk mengubah data diri pasien di sistem.</p>
            </div>
        </div>
        <form onsubmit="submitEditForm(event)" action="{{ route('admin.edit.pasien', $pasien->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="nama" class="block text-lg font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('nama', $pasien->nama) }}">
                @error('nama')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="nomor_handphone" class="block text-lg font-medium text-gray-700">Nomor Handphone</label>
                <input type="text" name="nomor_handphone" id="nomor_handphone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('nomor_handphone', $pasien->nomor_handphone) }}">
                @error('nomor_handphone')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="alamat" class="block text-lg font-medium text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('alamat', $pasien->alamat) }}">
                @error('alamat')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="pekerjaan" class="block text-lg font-medium text-gray-700">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('pekerjaan', $pasien->pekerjaan) }}">
                @error('pekerjaan')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label class="font-semibold" for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="rounded-lg" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}">
                @error('tanggal_lahir')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <p class="font-semibold">Jenis Kelamin</p>
                <div>
                    <input type="radio" id="L" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                    <label class="font-semibold mr-2" for="L">Laki-laki</label>
                    <input type="radio" id="P" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                    <label class="font-semibold" for="P">Perempuan</label>
                    @error('jenis_kelamin')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end">
                <button class="mr-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1">Ubah</button>
                <a href="{{ route('admin.data.pasien') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection