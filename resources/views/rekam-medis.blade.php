@extends('layouts.main')

@section('container')

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-[#222C67]">Rekam Medis Pasien</h1>
    </div>

    <hr class="border-1 border-[#B1B0AF] mb-8">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Medical Record Card 1 -->
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold text-[#222C67] mb-2">Dr. blabla</h2>
                <p class="text-lg text-gray-600 mb-4">Spesialis Penyakit Dalam</p>
                <p class="text-md text-gray-600 mb-4">Tanggal Kunjungan: 1 Januari 2024</p>
                <p class="text-md text-gray-600">Diagnosa: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="mt-4">
                <a href="{{ route('pasien.detail-rekam-medis') }}">
                    <button class="bg-[#E8C51C] hover:bg-[#d3da78] text-[#130D19] font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300">Detail</button>
                </a>
            </div>
        </div>

        <!-- Medical Record Card 2 -->
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold text-[#222C67] mb-2">Dr. yaya</h2>
                <p class="text-lg text-gray-600 mb-4">Spesialis Anak</p>
                <p class="text-md text-gray-600 mb-4">Tanggal Kunjungan: 10 Februari 2024</p>
                <p class="text-md text-gray-600">Diagnosa: Pellentesque habitant morbi tristique senectus et netus et malesuada fames.</p>
            </div>
            <div class="mt-4">
                <a href="{{ route('pasien.detail-rekam-medis') }}">
                    <button class="bg-[#E8C51C] hover:bg-[#d3da78] text-[#130D19] font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300">Detail</button>
                </a>
            </div>
        </div>

        <!-- Medical Record Card 3 -->
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold text-[#222C67] mb-2">Dr. zizi</h2>
                <p class="text-lg text-gray-600 mb-4">Spesialis Jantung</p>
                <p class="text-md text-gray-600 mb-4">Tanggal Kunjungan: 15 Maret 2024</p>
                <p class="text-md text-gray-600">Diagnosa: Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
            </div>
            <div class="mt-4">
                <a href="{{ route('pasien.detail-rekam-medis') }}">
                    <button class="bg-[#E8C51C] hover:bg-[#d3da78] text-[#130D19] font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300">Detail</button>
                </a>
            </div>
        </div>

        <!-- Add more cards as needed -->
    </div>
</div>

@endsection
