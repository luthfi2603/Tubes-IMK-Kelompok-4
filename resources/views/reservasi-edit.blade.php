@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] text-[#0f5132] dark:bg-[#1e5128] dark:text-[#d1e7dd] border-2 border-[#badbcc] dark:border-[#1e5128] px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] text-[#842029] dark:bg-[#3b0a0a] dark:text-[#f8d7da] border-2 border-[#f5c2c7] dark:border-[#3b0a0a] px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div class="container mx-auto p-4 dark:text-gray-200">
    <div class="bg-[#d3e2f1] dark:bg-gray-900 rounded-lg shadow-lg p-6 mb-6">
        <div class="flex justify-start items-center mb-4">
            <img src="{{ asset('assets/img/patient_illustration.png') }}" alt="Patient Illustration" class="w-20 h-20 mr-4">
            <h1 class="text-3xl font-bold text-[#0A0A0A] dark:text-gray-200">Ubah Reservasi Pasien</h1>
        </div>
        <form onsubmit="submitEditForm(event)" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
                
                <div>
                    <label for="tanggal" class="block text-md font-medium text-[#130D19] dark:text-gray-200">Tanggal Reservasi</label>
                    <input type="date" id="tanggal" name="tanggal" class="mt-1 block w-full px-4 py-2 border-gray-300 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" value="{{ old('tanggal', $reservasi->tanggal) }}">
                    <p id="informasi-hari" class="hidden text-[#130D19] dark:text-gray-200 font-semibold"></p> 
                        @error('tanggal')
                            <div class="text-[#B42223] text-bold text-md">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
            
            
                <div>
                    <label for="spesialis" class="block text-md font-medium text-[#130D19] dark:text-gray-200">Spesialis</label>
                    <select id="spesialis" name="spesialis" class="mt-1 block w-full px-4 py-2 border-gray-300 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Pilih Spesialis</option>
                        @foreach($spesialis as $item)
                            <option {{ old('spesialis', $reservasi->spesialis) === $item->spesialis ? 'selected' : '' }}>{{ $item->spesialis }}</option>
                        @endforeach
                    </select>
                    @error('spesialis')
                        <div class="text-[#B42223] text-bold text-md">
                            {{ $message }}
                        </div>
                     @enderror
                
            </div>
            <div>
                <label for="dokter" class="block text-md font-medium text-[#130D19] dark:text-gray-200">Dokter</label>
                <select id="dokter" name="dokter" disabled class="mt-1 block w-full px-4 py-2 border-gray-300 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih Tanggal dan Spesialis Dulu</option>
                </select>
                @error('dokter')
                    <div class="text-[#B42223] text-bold text-md">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-semibold px-4 py-2 rounded-md shadow-md transition duration-300"><i class="fa-solid fa-calendar-check mr-2"></i> Reservasi</button>
                <a href="{{ route('reservasi') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg py-2 px-4 w-min text-nowrap flex-items-center"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        const csrf = '{{ csrf_token() }}';
        const nama = '{{ $reservasi->nama_dokter }}';
        const waktu = '{{ $reservasi->jam }}';
    </script>
    <script src="{{ asset('assets/js/reservasi.js') }}"></script>
@endpush
@endsection
