@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] dark:bg-green-800 text-[#0f5132] dark:text-green-200 border-2 border-[#badbcc] dark:border-green-700 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] dark:bg-red-800 text-[#842029] dark:text-red-200 border-2 border-[#f5c2c7] dark:border-red-700 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67] dark:text-white">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white">Rekam Medis Pasien</h1>
    </div>
    <input type="date" id="tanggal" class="rounded-lg font-semibold dark:bg-gray-700 dark:text-gray-300">
</div>
<hr class="border-1 border-[#B1B0AF] dark:border-gray-700 mb-5 mx-4">
<div class="container mx-auto p-4 mb-72">
    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-900">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Diagnosa</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="isi-tabel">
                @if($rekamMedis->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-3">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 inline-flex items-center text-gray-500 dark:text-gray-300">
                                <i class="fa-regular fa-file mr-3"></i>  
                                <span class="text-lg font-semibold">Data tidak ada</span>
                            </div>
                        </td>
                    </tr>
                @else
                    @php
                        $halamanSekarang = request('page');
                        if(empty($halamanSekarang)){
                            $i = 1;
                        }else{
                            $i = ($halamanSekarang * 10) - 9;
                        }
                    @endphp
                    @foreach($rekamMedis as $rekam)
                        <tr class="bg-white dark:bg-gray-900 hover:bg-[#d1e4f2] transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">{{ $i }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">
                                @if($rekam->foto)
                                    <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300 dark:border-gray-600">
                                        <img src="{{ asset('storage/' . $rekam->foto) }}" alt="pasien" class="object-cover object-top w-full h-full">
                                    </div>
                                @else
                                    <div class="w-20 h-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle dark:stroke-gray-300">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"/>
                                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">{{ $rekam->nama_pasien }}</td>
                            <td class="px-6 py-4 text-md text-gray-900 dark:text-gray-300">
                                <textarea class="rounded-lg h-40 w-full border p-2 dark:bg-gray-700 dark:text-gray-300" readonly>{{ $rekam->diagnosa }}</textarea>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md">
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('dokter.rekam.medis.show', $rekam->id) }}" class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded-lg w-full text-center transition-colors duration-300 dark:bg-blue-500 dark:hover:bg-blue-400"><i class="fa-solid fa-circle-info mr-2"></i>Detail</a>
                                    <a href="{{ route('dokter.rekam.medis.edit', $rekam->id) }}" class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg w-full text-center transition-colors duration-300 dark:bg-yellow-500 dark:hover:bg-yellow-400"><i class="fa-solid fa-pen-to-square mr-2"></i>Ubah</a>
                                    <form onsubmit="hapusRekamMedis(event)" method="POST" action="{{ route('dokter.rekam.medis.destroy', $rekam->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 hover:bg-red-500 rounded-lg w-full py-1 px-3 text-white transition-colors duration-300 dark:bg-red-500 dark:hover:bg-red-400 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/rekam-medis.js') }}"></script>
@endpush
@endsection