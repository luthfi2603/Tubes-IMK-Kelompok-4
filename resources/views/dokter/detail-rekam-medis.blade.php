@extends('layouts.main')

@section('container')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white text-[#222C67] dark:text-white">Detail Rekam Medis</h1>
        <a href="{{ route('dokter.rekam.medis') }}" class="bg-[#E8C51C] hover:bg-[#d3da78] font-semibold text-white px-4 py-2 rounded-lg shadow-md transition duration-300 flex justify-center items-center"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col items-center mb-6">
            <div class="flex flex-col lg:flex-row w-full mb-4">
                <div class="flex w-full lg:w-1/5 mb-4 lg:mb-0 items-center max-[1024px]:justify-center">
                    <img src="{{ asset('assets/img/logo.png') }}" class="w-32 h-32" alt="logo">
                </div>
                <div class="w-full lg:w-3/5 text-center lg:text-center">
                    <p class="text-xl font-bold dark:text-white">{{ $rekamMedis->nama_dokter }}</p>
                    <p class="dark:text-gray-300">{{ $rekamMedis->spesialis }}</p>
                    <p class="dark:text-gray-300">RH61 Clinic, Jl. Ringroad (Jl. Gagak Hitam)</p>
                    <p class="dark:text-gray-300">Komplek Ruko OCBC No. 61, Medan</p>
                    <p class="dark:text-gray-300">Telp. (061) 42081004 - 42081005 HP. 08116176661</p>
                </div>
                <div class="w-full lg:w-1/5 text-center lg:text-right lg:pl-5">
                    <p class="dark:text-gray-300">Jam Hadir: {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('H:i') }}</p>
                </div>
            </div>
            <p class="underline text-lg mb-8 font-bold dark:text-white">Kartu Berobat</p>
            <div class="flex flex-col lg:flex-row w-full mb-4">
                <div class="w-full lg:w-1/2 ml-5">
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold dark:text-gray-300">No.</div>
                        <div class="w-1/12 dark:text-gray-300">:</div>
                        <div class="w-7/12 dark:text-gray-300">{{ $rekamMedis->id }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold dark:text-gray-300">Nama</div>
                        <div class="w-1/12 dark:text-gray-300">:</div>
                        <div class="w-7/12 dark:text-gray-300">{{ $rekamMedis->nama_pasien }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold dark:text-gray-300">Umur</div>
                        <div class="w-1/12 dark:text-gray-300">:</div>
                        <div class="w-7/12 dark:text-gray-300">{{ $rekamMedis->umur }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold dark:text-gray-300">Tanggal</div>
                        <div class="w-1/12 dark:text-gray-300">:</div>
                        <div class="w-7/12 dark:text-gray-300">{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('Y-m-d') }}</div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 ml-5">
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold dark:text-gray-300">Pekerjaan</div>
                        <div class="w-1/12 dark:text-gray-300">:</div>
                        <div class="w-7/12 dark:text-gray-300">{{ $rekamMedis->pekerjaan }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold dark:text-gray-300">Alamat</div>
                        <div class="w-1/12 dark:text-gray-300">:</div>
                        <div class="w-1/2 dark:text-gray-300">{{ $rekamMedis->alamat }}</div>
                    </div>
                    <div class="flex mb-2">
                        <div class="w-4/12 font-semibold dark:text-gray-300">Nomor Handphone</div>
                        <div class="w-1/12 dark:text-gray-300">:</div>
                        <div class="w-7/12 dark:text-gray-300">{{ $rekamMedis->nomor_handphone }}</div>
                    </div>
                </div>
            </div>
            <hr class="w-full mb-4 dark:border-gray-700">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-[#1f2937] border border-gray-300 dark:border-gray-700">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Keluhan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Diagnosa</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Therapie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-6 py-4 border-t border-gray-300 dark:border-gray-700 align-top">
                                <pre class="text-wrap font-body dark:text-gray-300">{{ $rekamMedis->keluhan }}</pre>
                            </td>
                            <td class="px-6 py-4 border-t border-gray-300 dark:border-gray-700 align-top">
                                <pre class="text-wrap font-body dark:text-gray-300">{{ $rekamMedis->diagnosa }}</pre>
                            </td>
                            <td class="px-6 py-4 border-t border-gray-300 dark:border-gray-700 align-top">
                                <pre class="text-wrap font-body dark:text-gray-300">{{ $rekamMedis->therapie }}</pre>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
