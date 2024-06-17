@extends('layouts.main')

@section('container')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#222C67]">Detail Rekam Medis</h1>
        <a href="{{ route('dokter.rekam.medis') }}" class="bg-[#E8C51C] hover:bg-[#d3da78] font-semibold text-white px-4 py-2 rounded-lg shadow-md transition duration-300 flex justify-center items-center"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col items-center mb-6">
            <div class="flex flex-col lg:flex-row w-full mb-4">
                <div class="flex w-full lg:w-1/5 mb-4 lg:mb-0 items-center max-[1024px]:justify-center">
                    <img src="{{ asset('assets/img/logo.png') }}" class="w-32 h-32" alt="logo">
                </div>
                <div class="w-full lg:w-3/5 text-center lg:text-center">
                    <p class="text-xl font-bold">{{ $rekamMedis->nama_dokter }}</p>
                    <p>{{ $rekamMedis->spesialis }}</p>
                    <p>RH61 Clinic, Jl. Ringroad (Jl. Gagak Hitam)</p>
                    <p>Komplek Ruko OCBC No. 61, Medan</p>
                    <p>Telp. (061) 42081004 - 42081005 HP. 08116176661</p>
                </div>
                <div class="w-full lg:w-1/5 text-center lg:text-right lg:pl-5">
                    <p>Jam Hadir: {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('H:i') }}</p>
                </div>
            </div>
            <p class="underline text-lg mb-8 font-bold">Kartu Berobat</p>
            <div class="flex flex-col lg:flex-row w-full mb-4">
                <div class="w-full lg:w-1/2 ml-5">
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold">No.</div>
                        <div class="w-1/12">:</div>
                        <div class="w-7/12">{{ $rekamMedis->id }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold">Nama</div>
                        <div class="w-1/12">:</div>
                        <div class="w-7/12">{{ $rekamMedis->nama_pasien }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold">Umur</div>
                        <div class="w-1/12">:</div>
                        <div class="w-7/12">{{ $rekamMedis->umur }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold">Tanggal</div>
                        <div class="w-1/12">:</div>
                        <div class="w-7/12">{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('Y-m-d') }}</div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 ml-5">
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold">Pekerjaan</div>
                        <div class="w-1/12">:</div>
                        <div class="w-7/12">{{ $rekamMedis->pekerjaan }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold">Alamat</div>
                        <div class="w-1/12">:</div>
                        <div class="w-1/2">{{ $rekamMedis->alamat }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold">Nomor Handphone</div>
                        <div class="w-1/12">:</div>
                        <div class="w-7/12">{{ $rekamMedis->nomor_handphone }}</div>
                    </div>
                    
                </div>
            </div>
            <hr class="w-full mb-4">
            
            <div class="w-full overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Keluhan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Diagnosa</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Therapie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-6 py-4 border-t border-gray-300 align-top">
                                <pre class="text-wrap font-body">{{ $rekamMedis->keluhan }}</pre>
                            </td>
                            <td class="px-6 py-4 border-t border-gray-300 align-top">
                                <pre class="text-wrap font-body">{{ $rekamMedis->diagnosa }}</pre>
                            </td>
                            <td class="px-6 py-4 border-t border-gray-300 align-top">
                                <pre class="text-wrap font-body">{{ $rekamMedis->therapie }}</pre>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection