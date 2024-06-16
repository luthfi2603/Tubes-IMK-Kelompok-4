@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif
<div class="flex justify-between items-center mb-4 mx-4">
    <h1 class="text-3xl font-bold">Kelola Perawat</h1>
    <a href="{{ route('admin.perawat.input') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Perawat
    </a>
</div>
<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">
<div class="container mx-auto px-4 py-6">
    @if($perawats->isEmpty())
    <div class="flex justify-center items-center">
        <div class="bg-[#E3EBF3] text-center p-4 rounded-lg shadow-md font-bold w-3/4 flex items-center justify-center space-x-4">
            <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
            <p class="text-xl text-[#222C67]">Perawat Tidak Ada</p>
            <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
        </div>
    </div>
    @else
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nomor Handphone</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Alamat</th>
                    </tr>
                </thead>
                <tbody id="isi-tabel" class="divide-y divide-gray-200">
                    @php
                        $halamanSekarang = request('page');
                        $i = empty($halamanSekarang) ? 1 : ($halamanSekarang * 10) - 9;
                    @endphp
                    @foreach($perawats as $item)
                    <tr class="bg-white hover:bg-[#d1e4f2] transition duration-200">
                        <td class="p-4 whitespace-nowrap text-md text-gray-900">{{ $i }}</td>
                        <td class="p-4 whitespace-nowrap text-md text-gray-900 flex flex-col gap-2">
                            <a href="{{ route('admin.perawat.edit', $item->nomor_handphone) }}" class="bg-yellow-400 text-white px-2 py-1 rounded shadow hover:bg-yellow-500 flex items-center">
                                <i class="fa-solid fa-pen-to-square mr-2"></i>
                                Ubah
                            </a>
                            <form onsubmit="hapusPerawat(event)" action="{{ route('admin.perawat.destroy', $item->id_user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-2 py-1 rounded shadow hover:bg-red-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                        <td class="p-4 whitespace-nowrap text-md text-gray-900">
                            @if($item->foto)
                                <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="perawat" class="object-cover object-top w-full h-full">
                                </div>
                            @else
                                <div class="w-20 h-20">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="p-4 whitespace-nowrap text-md text-gray-900">{{ $item->nama }}</td>
                        <td class="p-4 whitespace-nowrap text-md text-gray-900">{{ $item->nomor_handphone }}</td>
                        <td class="p-4 whitespace-nowrap text-md text-gray-900">{{ $item->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                        <td class="p-4 whitespace-nowrap text-md text-gray-900">{{ $item->alamat }}</td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4" id="pagination">
            {{ $perawats->links() }}
        </div>
    @endif
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/kelola-perawat.js') }}"></script>
@endpush
@endsection