@extends('layouts.main')

@section('container')
<div id="success-js" class="hidden bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]"><i class="fa-regular fa-circle-check mr-1"></i></div>
<div id="failed-js" class="hidden bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]"><i class="fa-solid fa-circle-exclamation mr-1"></i></div>

<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Daftar Reservasi</h1>
    </div>
    <div class="flex items-center gap-4">
        <svg id="tombol-refresh" class="cursor-pointer"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
        <input type="date" id="tanggal" class="rounded-lg">
    </div>
</div>
<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">
<div class="flex-1 p-6">
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded-lg text-center flex items-center justify-center">
            <div>
                <div class="text-3xl font-bold">105</div>
                <div>Total Pasien</div>
            </div>
        </div>
        <div class="bg-[#7f89c0] text-white p-4 max-w-full rounded-lg flex items-center col-span-3">
            <div class="flex-1">
                <p class="font-bold text-lg sm:text-md max-[640px]:text-sm">Selamat datang, Dokter! Manajemen reservasi yang lebih baik untuk pelayanan yang lebih maksimal.</p>
            </div>
            <div>
                <img src="{{ asset('assets/img/dokter-3.png') }}" alt="Doctor" class="w-24 h-24 max-[640px]:w-16 max-[640px]:h-16">
            </div>
        </div>
    </div>
    
    
    
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="block w-full overflow-x-auto">
            <table class="min-w-full bg-white shadow-md">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-10 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Pasien</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama Pasien</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Umur</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nomor Handphone</th>
                    </tr>
                </thead>
                <tbody id="isi-tabel">
                    @if($antrians->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center py-3">
                            <div class="bg-gray-100 rounded-lg p-4 inline-flex items-center text-gray-500 ">
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
                            <tr class="bg-white hover:bg-[#d1e4f2] transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $i }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md">
                                    @if($item->id_rekam_medis)
                                        <a class="px-4 py-2 bg-green-300 text-white rounded-lg" disabled>
                                            Rekam medis telah dibuat
                                        </a>
                                    @else
                                        @if($item->status == 'Batal')
                                            <a class="px-4 py-2 bg-red-300 text-white rounded-lg" disabled>
                                                Reservasi dibatalkan
                                            </a>
                                        @else
                                            <a href="{{ route('dokter.rekam.medis.create', $item->id) }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 w-min text-white rounded-lg flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Rekam Medis
                                            </a>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                                    @if($item->foto)
                                        <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="pasien" class="object-cover object-top w-full h-full">
                                        </div>
                                    @else
                                        <div class="w-20 h-20">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-md text-blue-500">{{ $item->nama_pasien }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md text-center">
                                    <span class="px-4 py-1 inline-flex text-md leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->umur }}</td>  
                                <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->nomor_handphone }}</td>         
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/janji-temu-dokter.js') }}"></script>
@endpush
@endsection