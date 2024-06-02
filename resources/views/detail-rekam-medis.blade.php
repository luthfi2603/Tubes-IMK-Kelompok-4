@extends('layouts.main')

@section('container')

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#222C67]">Detail Rekam Medis</h1>
        <a href="{{ route('pasien.rekam-medis') }}">
            <button class="bg-[#E8C51C] hover:bg-[#d3da78] font-semibold text-gray-700 px-4 py-2 rounded-full shadow-md transition duration-300">Kembali</button>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold text-[#222C67] mb-4">Dr. Najwa Alpina</h2>
        <p class="text-lg text-gray-600 mb-2">Spesialis: Ginjal</p>
        <p class="text-lg text-gray-600 mb-2">Tanggal Kunjungan: 22/02/2023</p>
        <p class="text-lg text-gray-600 mb-4">Diagnosa: Gangguan Jiwa</p>
        
        <h3 class="text-xl font-bold text-[#222C67] mb-2">Catatan Medis:</h3>
        <p class="text-md text-gray-600 mb-4">Gangguan jiwa nya uda parah ini, gausa berobat lagi ya</p>
        
        <h3 class="text-xl font-bold text-[#222C67] mb-2">Resep Obat:</h3>
        <ul class="list-disc list-inside text-md text-gray-600 mb-4">
            {{-- @foreach($prescriptions as $prescription) --}}
                <li>Paracetamol 500 gram</li>
            {{-- @endforeach --}}
        </ul>
        
        <h3 class="text-xl font-bold text-[#222C67] mb-2">Tindakan Lanjut:</h3>
        <ul class="list-disc list-inside text-md text-gray-600">
            {{-- @foreach($followUpActions as $action) --}}
                <li>Tidur sambil salto</li>
            {{-- @endforeach --}}
        </ul>
    </div>
</div>

@endsection
