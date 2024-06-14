@extends('admin.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif
<div class="flex justify-between items-center mb-4 mx-4">
    <h1 class="text-3xl font-bold">Kelola Dokter</h1>
    <a href="{{ route('admin.dokter.input') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center font-semibold">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Dokter
    </a>
</div>
<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">
<div class="container mx-auto p-4">
    @if($dokters->isEmpty())
        {{-- <div class="mt-4 text-center">
            <p class="text-xl font-bold">Dokter Tidak Ada</p>
        </div> --}}
        <div class="flex justify-center items-center">
            <div class="bg-[#E3EBF3] text-center p-4 rounded-lg shadow-md font-bold w-3/4 flex items-center justify-center space-x-4">
                <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                <p class="text-xl text-[#222C67]">Belum ada Data</p>
                <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
            </div>
        </div>
    @else
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nomor Handphone</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Spesialis</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Alamat</th>
                    </tr>
                </thead>
                <tbody id="isi-tabel" class="divide-y divide-gray-200">
                    @php
                        $halamanSekarang = request('page');
                        if(empty($halamanSekarang)){
                            $i = 1;
                        }else{
                            $i = ($halamanSekarang * 10) - 9;
                        }
                    @endphp
                    @foreach($dokters as $item)
                        <tr class="bg-white hover:bg-[#d1e4f2] transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $i }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.dokter.edit', $item->nomor_handphone) }}" class="bg-yellow-400 text-white px-2 py-1 rounded shadow hover:bg-yellow-500 flex items-center w-min">
                                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                                        Ubah
                                    </a>
                                    <a href="{{ route('admin.dokter.edit.jadwal', $item->id_dokter) }}" class="bg-cyan-400 text-white px-2 py-1 rounded shadow hover:bg-cyan-500 flex items-center">
                                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                                        Ubah Jadwal
                                    </a>
                                    <form action="{{ route('admin.dokter.destroy', $item->id_user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white px-2 py-1 rounded shadow hover:bg-red-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                                @if($item->foto)
                                    <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="dokter" class="object-cover object-top w-full h-full">
                                    </div>
                                @else
                                    <div class="w-20 h-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->nomor_handphone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki'}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->spesialis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->alamat }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
            {{-- <div id="loading-perawat" class="absolute z-[999] inset-0 hidden">
                <div class="flex flex-col items-center justify-center min-h-screen">
                    <div class="absolute inset-0 -z-10">
                        <div class="absolute inset-0 bg-zinc-700/70"></div>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-live="polite" aria-busy="true" aria-labelledby="title-08a desc-08a" class="h-20 w-20">
                        <path d="M7 8H3V16H7V8Z" class="animate animate-bounce fill-cyan-500 " />
                        <path d="M14 8H10V16H14V8Z" class="animate animate-bounce fill-cyan-500 [animation-delay:.2s]" />
                        <path d="M21 8H17V16H21V8Z" class="animate animate-bounce fill-cyan-500 [animation-delay:.4s]" />
                    </svg>
                    <h1 class="text-2xl font-semibold text-cyan-500 text-center">Loading, tunggu sebentar...</h1>
                </div>
            </div> --}}
        </div>
        <div id="pagination" class="mt-4">
            {{ $dokters->links() }}
        </div>
    @endif
</div>

@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/kelola-dokter.js') }}"></script>
@endpush
@endsection