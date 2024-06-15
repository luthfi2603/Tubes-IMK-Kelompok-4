@extends('layouts.main')

@section('container')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#222C67]">Detail Rekam Medis</h1>
        <a href="{{ route('dokter.rekam.medis') }}" class="bg-[#E8C51C] hover:bg-[#d3da78] font-semibold text-gray-700 px-4 py-2 rounded-full shadow-md transition duration-300">Kembali</a>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col items-center">
            <div class="flex w-full">
                <div class="w-1/5">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
                </div>
                <div class="flex flex-col items-center w-3/5">
                    <p>{{ $rekamMedis->nama_dokter }}</p>
                    <p>{{ $rekamMedis->spesialis }}</p>
                    <p>RH61 Clinic, Jl. Ringroad (Jl. Gagak Hitam)</p>
                    <p>Komplek Ruko OCBC No. 61, Medan</p>
                    <p>Telp. (061) 42081004 - 42081005 HP. 08116176661</p>
                </div>
                <div class="w-1/5">
                    Jam Hadir : {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('H:i') }}
                </div>
            </div>
            <p class="underline">Kartu Berobat</p>
            <div class="flex w-full">
                <div class="w-1/2 flex flex-col">
                    <div class="flex">
                        <div class="w-4/12">
                            No.
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            {{ $rekamMedis->id }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-4/12">
                            Nama
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            {{ $rekamMedis->nama_pasien }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-4/12">
                            Umur
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            {{ $rekamMedis->umur }}
                        </div>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col">
                    <div class="flex">
                        <div class="w-4/12">
                            Pekerjaan
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            {{ $rekamMedis->pekerjaan }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-4/12">
                            Alamat
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            {{ $rekamMedis->alamat }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-4/12">
                            Nomor Handphone
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            {{ $rekamMedis->nomor_handphone }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="w-full">
                <p>Tanggal : {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('Y-m-d') }}</p>
            </div>
            <table class="border-4 border-black">
                <thead>
                    <tr>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Therapie</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-4">
                            <p>
                                {!! $rekamMedis->keluhan !!}</td>
                            </p>
                        <td class="p-4">{{ $rekamMedis->diagnosa }}</td>
                        <td class="p-4">{{ $rekamMedis->therapie }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
