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
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Tambah Rekam Medis Pasien</h1>
    </div>
</div>
<hr class="border-1 border-[#B1B0AF] mb-5 mx-4">
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <form method="POST">
        @csrf
        <div class="mb-4">
            <label for="keluhan" class="block text-gray-700 text-md font-bold mb-2">Keluhan:</label>
            <textarea class="w-full rounded-lg h-32" name="keluhan" id="keluhan" placeholder="Masukkan keluhan..">{{ old('keluhan') }}</textarea>
            @error('keluhan')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="diagnosa" class="block text-gray-700 text-md font-bold mb-2">Diagnosa:</label>
            <textarea class="w-full rounded-lg h-32" name="diagnosa" id="diagnosa" placeholder="Masukkan diagnosa..">{{ old('diagnosa') }}</textarea>
            @error('diagnosa')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="therapie" class="block text-gray-700 text-md font-bold mb-2">Therapie:</label>
            <textarea class="w-full rounded-lg h-32" name="therapie" id="therapie" placeholder="Masukkan therapie..">{{ old('therapie') }}</textarea>
            @error('therapie')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex items-center justify-end mt-6 mb-4 gap-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                <i class="fa-solid fa-floppy-disk mr-2"></i>Simpan
            </button>
            <button type="reset" class="inline-block align-baseline font-bold text-md text-red-500 hover:text-red-700">
                <i class="fa-solid fa-arrows-rotate mr-2"></i>Reset
            </button>
            <a href="{{ route('dokter.janji.temu') }}" class="inline-block align-baseline font-bold text-md text-yellow-500 hover:text-yellow-800">
                <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </form>
</div>
@endsection