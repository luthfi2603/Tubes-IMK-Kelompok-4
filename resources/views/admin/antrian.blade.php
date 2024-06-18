@extends('layouts.main')

@section('container')
<div id="success-js" class="bg-[#d1e7dd] dark:bg-green-800 text-[#0f5132] dark:text-green-200 border-2 border-[#badbcc] dark:border-green-700 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px] hidden">
    <i class="fa-regular fa-circle-check mr-1"></i>
    <span></span>
</div>
<div id="failed-js" class="bg-[#f8d7da] dark:bg-red-800 text-[#842029] dark:text-red-200 border-2 border-[#f5c2c7] dark:border-red-700 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px] hidden">
    <i class="fa-solid fa-circle-exclamation mr-1"></i>
    <span></span>
</div>
<div class="flex justify-between items-center px-4 mb-4">
    <div class="font-body font-bold text-[#222C67] dark:text-white">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white">Antrian</h1>
    </div>
    <div class="flex items-center gap-4">
        <svg id="tombol-refresh" class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
        <input type="date" id="tanggal" class="rounded-lg dark:bg-gray-700 dark:text-white">
    </div>
</div>
<hr class="border-1 border-[#B1B0AF] dark:border-gray-600 mb-4 mx-4">
<div class="container mx-auto p-4 mb-72">
    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-900">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">Aksi</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">Status</th>
                    {{-- <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider min-w-40">Jam Reservasi</th> --}}
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">Nama Dokter</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">Nomor Handphone Pasien</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 dark:border-gray-600 text-left text-sm font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">Alamat Pasien</th>
                </tr>
            </thead>
            <tbody id="isi-tabel" class="divide-y divide-gray-200 dark:divide-gray-700">
                @if($antrians->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center text-2xl py-3">
                            <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4 inline-flex items-center text-gray-500 dark:text-gray-400">
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
                    @foreach ($antrians as $item)
                        <tr class="bg-white dark:bg-gray-900 hover:bg-[#d1e4f2] dark:hover:bg-gray-700 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">{{ $i }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">
                                <div class="dropdown" data-placement="right">
                                    @if($item->status == 'Menunggu')
                                        <button class="dropdown-toggle bg-yellow-500 dark:bg-yellow-600 text-white px-3 py-1 rounded tombol-ubah shadow flex items-center" id="{{ $item->id }}">
                                    @else
                                        <button class="dropdown-toggle bg-yellow-300 dark:bg-yellow-400 text-white px-3 py-1 rounded tombol-ubah shadow flex items-center" disabled>
                                    @endif
                                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                                        Ubah
                                    </button>
                                    <div class="dropdown-menu hidden p-4 rounded-lg bg-[#F5F5F5] dark:bg-gray-900">
                                        <div class="flex flex-col gap-4">
                                            <button id="selesai" class="bg-green-100 dark:bg-green-600 dark:text-green-200 text-green-800 text-sm px-2 py-1 leading-5 font-semibold rounded shadow w-full">
                                                Selesai
                                            </button>
                                            <button id="batal" class="bg-red-100 dark:bg-red-600 dark:text-red-200 text-red-800 text-sm px-2 py-1 leading-5 font-semibold rounded shadow w-full">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">
                                @if($item->foto)
                                    <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300 dark:border-gray-600">
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="perawat" class="object-cover object-top w-full h-full">
                                    </div>
                                @else
                                    <div class="w-20 h-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"/>
                                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md">
                                @if($item->status == 'Selesai')
                                    <span class="bg-green-100 dark:bg-green-600 dark:text-green-200 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded shadow">Selesai</span>
                                @elseif($item->status == 'Menunggu')
                                    <span class="bg-yellow-100 dark:bg-yellow-600 dark:text-yellow-200 text-yellow-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded shadow">Menunggu</span>
                                @else
                                    <span class="bg-red-100 dark:bg-red-600 dark:text-red-200 text-red-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded shadow">Batal</span>
                                @endif
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($item->updated_at)->format('H:i:s') }}
                            </td> --}}
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">{{ $item->nama_pasien }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">{{ $item->nama_dokter }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">
                                @if($item->waktu_rekomendasi)
                                    {{ $item->waktu_rekomendasi }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">{{ $item->nomor_handphone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">{{ $item->alamat }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{-- <div id="pagination" class="mt-4">
        {{ $antrians->links() }}
    </div> --}}
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/antrian.js') }}"></script>
@endpush
@endsection
