@extends('admin.main')

@section('container')
<div id="success-js" class="hidden bg-green-300 py-3 text-white px-4 rounded-lg fixed inset-x-4 top-4 z-[99]">
    Status antrian berhasil diubah
</div>
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Antrian</h1>
    </div>
    <input type="date" id="tanggal">
</div>
<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">
<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    {{-- <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jam Reservasi</th> --}}
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama Dokter</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nomor Handphone</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Alamat Pasien</th>
                </tr>
            </thead>
            <tbody id="isi-tabel">
                @if($antrians->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center text-2xl py-3">Data tidak ada</td>
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
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                                <div class="dropdown" data-placement="right">
                                    <button class="dropdown-toggle bg-blue-500 text-white px-3 py-1 mr-2 rounded-lg
                                            @if($item->status == 'Selesai' || $item->status == 'Batal')
                                                {{ 'bg-blue-300' }}
                                            @endif
                                        " id="{{ $item->id }}"
                                        @if($item->status == 'Selesai' || $item->status == 'Batal')
                                            {{ 'disabled' }}
                                        @endif
                                    >Ubah</button>
                                    <div class="dropdown-menu hidden p-4 rounded-lg bg-[#F5F5F5]">
                                        <button id="selesai" class="bg-green-100 text-green-800 text-sm px-2 py-1 leading-5 font-semibold rounded-lg w-full mt-2">
                                            Selesai
                                        </button> <br>
                                        <button id="batal" class="bg-red-100 text-red-800 text-sm px-2 py-1 leading-5 font-semibold rounded-lg w-full mt-2">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md">
                                @if($item->status == 'Selesai')
                                    <span class="bg-green-100 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Selesai</span>
                                @elseif($item->status == 'Menunggu')
                                    <span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Menunggu</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Batal</span>
                                @endif
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                                {{ \Carbon\Carbon::parse($item->updated_at)->format('H:i:s') }}
                            </td> --}}
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->nama_pasien }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->nama_dokter }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->nomor_handphone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->alamat }}</td>
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