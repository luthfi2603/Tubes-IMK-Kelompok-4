@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] dark:bg-[#2d3738] dark:text-[#d1e7dd] text-[#0f5132] border-2 dark:border-[#d1e7dd] border-[#badbcc] px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] dark:bg-[#4a2a2d] dark:text-[#f8d7da] text-[#842029] border-2 dark:border-[#f8d7da] border-[#f5c2c7] px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67] dark:text-white">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white">Tambah Rekam Medis Pasien</h1>
    </div>
</div>
<hr class="border-1 border-[#B1B0AF] dark:border-[#4b5563] mb-5 mx-4">
<div class="container mx-auto p-6 bg-white dark:bg-gray-900 shadow-lg rounded-lg">
    <form method="POST">
        @csrf
        <div class="mb-4">
            <label for="keluhan" class="block text-gray-700 dark:text-[#c7d1d9] text-md font-bold mb-2">Keluhan:</label>
            <textarea class="w-full rounded-lg h-32 dark:bg-[#374151] dark:text-[#c7d1d9]" name="keluhan" id="keluhan" placeholder="Masukkan keluhan..">{{ old('keluhan') }}</textarea>
            @error('keluhan')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="diagnosa" class="block text-gray-700 dark:text-[#c7d1d9] text-md font-bold mb-2">Diagnosa:</label>
            <textarea class="w-full rounded-lg h-32 dark:bg-[#374151] dark:text-[#c7d1d9]" name="diagnosa" id="diagnosa" placeholder="Masukkan diagnosa..">{{ old('diagnosa') }}</textarea>
            @error('diagnosa')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="therapie" class="block text-gray-700 dark:text-[#c7d1d9] text-md font-bold mb-2">Therapie:</label>
            <textarea class="w-full rounded-lg h-32 dark:bg-[#374151] dark:text-[#c7d1d9]" name="therapie" id="therapie" placeholder="Masukkan therapie..">{{ old('therapie') }}</textarea>
            @error('therapie')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex items-center justify-end mt-6 mb-4 gap-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                <i class="fa-solid fa-floppy-disk mr-2"></i>Simpan
            </button>
            <button type="reset" class="inline-block align-baseline font-bold text-md text-red-500 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600">
                <i class="fa-solid fa-arrows-rotate mr-2"></i>Reset
            </button>
            <a href="{{ route('dokter.janji.temu') }}" class="inline-block align-baseline font-bold text-md text-yellow-500 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-600">
                <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </form>
</div>
@endsection
