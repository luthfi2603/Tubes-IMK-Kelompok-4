@extends('dokter.main')

@section('container')

<div id="success-js" class="hidden bg-green-300 py-3 text-white px-4 rounded-lg fixed inset-x-4 top-4 z-[99]"></div>
<div id="failed-js" class="hidden bg-red-300 py-3 text-white px-4 rounded-lg fixed inset-x-4 top-4 z-[99]"></div>
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Janji temu</h1>
    </div>
    <input type="date" id="tanggal">
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
                        <td colspan="6" class="text-center text-2xl py-3">Data tidak ada</td>
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
                            <a href="{{ route('dokter.rekam.medis.create', $item->id) }}">
                                <button  class="px-4 py-2 bg-green-100 text-green-800 rounded-lg">Tambah Rekam Medis</button>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="Avatar">
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
