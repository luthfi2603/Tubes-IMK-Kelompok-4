@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-300">
        <div class="flex items-center mb-6">
            <img src="{{ asset('assets/img/doctor-add.png') }}" class="w-24 h-24" alt="">
            <div class="ml-4">
                <p class="text-2xl md:text-3xl font-bold">Tambah Dokter</p>
                <p class="text-gray-500 text-sm">Silahkan lengkapi formulir di bawah ini untuk menambahkan dokter baru ke sistem.</p>
            </div>
        </div>
        <form action="{{ route('admin.dokter.input') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
                <div class="flex flex-col items-center w-full">
                    <svg id="ikon-bawaan" class="w-2/5 h-2/5 md:w-52 md:h-52" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                    <div id="div-foto" class="w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 hidden mb-4">
                        <img id="tampilkan-foto" alt="foto-profil" class="object-cover object-top w-full h-full">
                    </div>
                    <div class="flex gap-2">
                        <button id="tombol-pilih-foto" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"><i class="fa-solid fa-pen-to-square mr-2"></i>Pilih Foto</button>
                        <button id="tombol-hapus-foto" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900"><i class="fa-solid fa-trash mr-2"></i>Hapus Foto</button>
                    </div>
                    <input type="file" name="foto" id="foto" class="hidden">
                    <div id="error-message" class="text-[#B42223] text-bold text-sm w-full mt-5"></div>
                    @error('foto')
                        <div class="text-[#B42223] text-bold text-sm w-full mt-4">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            <div class="flex flex-col w-full">
                <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('nama') }}">
                @error('nama')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="nomor_handphone" class="block text-gray-700 font-semibold mb-2">Nomor Handphone</label>
                <input type="number" name="nomor_handphone" id="nomor_handphone" placeholder="Masukkan nomor handphone" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('nomor_handphone') }}">
                @error('nomor_handphone')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="alamat" class="block text-gray-700 font-semibold mb-2">Alamat</label>
                <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('alamat') }}">
                @error('alamat')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="spesialis" class="block text-gray-700 font-semibold mb-2">Spesialis</label>
                <select id="spesialis" name="spesialis" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih spesialis</option>
                    <option {{ old('spesialis') === 'Penyakit Dalam' ? 'selected' : '' }}>Penyakit Dalam</option>
                    <option {{ old('spesialis') === 'Obgyn' ? 'selected' : '' }}>Obgyn</option>
                    <option {{ old('spesialis') === 'Estetika' ? 'selected' : '' }}>Estetika</option>
                </select>
                @error('spesialis')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <p class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</p>
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
            <div class="flex flex-col w-full relative">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Kata Sandi</label>
                <input type="password" name="password" id="password" placeholder="Masukkan kata sandi" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <i class="fa-solid fa-eye absolute right-3 bottom-3 cursor-pointer text-gray-500" id="toggle-password"></i>
                @error('password')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col w-full relative">
                <label for="konfirmasi_password" class="block text-gray-700 font-semibold mb-2">Konfirmasi Kata Sandi</label>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Masukkan konfirmasi kata sandi" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <i class="fa-solid fa-eye absolute right-3 bottom-3 cursor-pointer text-gray-500" id="toggle-password-2"></i>
                @error('konfirmasi_password')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 mr-2"><i class="fa-solid fa-floppy-disk mr-2"></i>Tambah</button>
                <a href="{{ route('admin.index.dokter') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg py-2 px-4"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('assets/js/input-perawat.js') }}"></script>
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
@endpush
@endsection