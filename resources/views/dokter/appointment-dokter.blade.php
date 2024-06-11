@extends('dokter.main')

@section('container')
<div id="success-js" class="hidden bg-green-300 py-3 text-white px-4 rounded-lg fixed inset-x-4 top-4 z-[99]"></div>
<div id="failed-js" class="hidden bg-red-300 py-3 text-white px-4 rounded-lg fixed inset-x-4 top-4 z-[99]"></div>
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Janji temu</h1>
    </div>
    <div class="flex items-center gap-4">
        <svg id="tombol-refresh" class="cursor-pointer"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
        <input type="date" id="tanggal" class="rounded-lg">
    </div>
</div>
<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">
<div class="flex-1 p-6">
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded-lg text-center">
            <div class="text-3xl font-bold">105</div>
            <div>Total Patient</div>
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
                            <td colspan="7" class="text-center text-2xl py-3">Data tidak ada</td>
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $i }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    @if($item->id_rekam_medis)
                                        <a class="px-4 py-2 bg-green-300 text-white rounded-lg" disabled>
                                            Rekam medis telah dibuat
                                        </a>
                                    @else
                                        <a href="{{ route('dokter.rekam.medis.create', $item->id) }}" class="px-4 py-2 bg-green-500 text-white rounded-lg">
                                            Tambah Rekam Medis
                                        </a>
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