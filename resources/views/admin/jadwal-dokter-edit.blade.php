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
<div class="container mx-auto px-4 py-6 mb-44">
    <div class="max-w-6xl mx-auto bg-white dark:bg-gray-900 p-8 rounded-lg shadow-lg border border-gray-300 dark:border-gray-700">
        <div class="flex items-center mb-6">
            <img src="{{ asset('assets/img/doctor-add.png') }}" class="w-24 h-24" alt="">
            <div class="ml-4">
                <p class="text-2xl md:text-3xl font-bold dark:text-white">Edit Jadwal Dokter</p>
                <p class="text-gray-500 dark:text-gray-300 text-sm">Silahkan ubah jadwal dokter yang ada di sistem.</p>
            </div>
        </div>
        <form onsubmit="submitEditForm(event)" action="{{ route('admin.jadwal.dokter.edit', $jadwalDokter->id) }}" method="POST" class="flex justify-center">
            @csrf
            @method('PUT')
            <div class="flex flex-col items-center gap-4 w-full">
                <div class="flex flex-col w-full">
                    <label for="hari" class="dark:text-gray-300">Hari</label>
                    <select id="hari" name="hari" class="px-4 py-2 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300">
                        <option value="">Pilih Hari</option>
                        <option {{ old('hari', $jadwalDokter->hari) === 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option {{ old('hari', $jadwalDokter->hari) === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option {{ old('hari', $jadwalDokter->hari) === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option {{ old('hari', $jadwalDokter->hari) === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option {{ old('hari', $jadwalDokter->hari) === 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option {{ old('hari', $jadwalDokter->hari) === 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        <option {{ old('hari', $jadwalDokter->hari) === 'Minggu' ? 'selected' : '' }}>Minggu</option>
                    </select>
                    @error('hari')
                        <div class="text-[#B42223] text-bold text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col w-full">
                    <label for="jam" class="dark:text-gray-300">Jam</label>
                    <input type="text" name="jam" id="jam" placeholder="Masukkan jam yang valid, 08:00-13:00" class="rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" value="{{ old('jam', $jadwalDokter->jam) }}">
                    @error('jam')
                        <div class="text-[#B42223] text-bold text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex justify-end w-full">
                    <button class="mr-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1"><i class="fa-solid fa-floppy-disk mr-2"></i>Ubah</button>
                    <a href="{{ route('admin.jadwal.dokter.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
