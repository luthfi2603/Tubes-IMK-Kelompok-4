{{-- @extends('admin.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif
<div class="flex flex-col gap-4">
    <p class="text-2xl md:text-3xl font-bold">Kelola Perawat</p>
    <a href="{{ route('admin.perawat.input') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Tambah Perawat</a>
    @if($perawats->isEmpty())
        <div class="mt-4 text-center">
            <p class="text-xl font-bold">Perawat Tidak Ada</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm rounded-lg">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">#</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Aksi</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Foto</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Nama</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Nomor Handphone</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Jenis Kelamin</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Alamat</th>
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
                    @foreach($perawats as $item)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $i }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <a href="{{ route('admin.perawat.edit', $item->nomor_handphone) }}">Ubah</a>
                                <form action="{{ route('admin.perawat.destroy', $item->id_user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Hapus</button>
                                </form>
                            </td>
                            <td class="px-4 py-2 text-gray-700">
                                @if($item->foto)
                                    <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="perawat" class="object-cover object-top w-full h-full">
                                    </div>
                                @else
                                    <div class="w-20 h-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $item->nama }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $item->nomor_handphone }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $item->jenis_kelamin }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $item->alamat }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table> --}}
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

        {{-- </div>
        <div id="pagination">
            {{ $perawats->links() }}
        </div>
    @endif
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/kelola-perawat.js') }}"></script>
@endpush
@endsection --}}


@extends('admin.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold">Kelola Perawat</h1>
        <a href="{{ route('admin.perawat.input') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Perawat
        </a>
    </div>

    <hr class="border-1 border-[#B1B0AF] mb-8">

    @if($perawats->isEmpty())
        <div class="mt-4 text-center">
            <p class="text-xl font-bold">Perawat Tidak Ada</p>
        </div>
    @else
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full rounded-lg">
                <thead class="bg-gray-50 text-gray-800 text-sm font-semibold shadow">
                    <tr>
                        <th class="px-4 py-3 text-start">#</th>
                        <th class="px-4 py-3 text-start min-w-40">Foto</th>
                        <th class="px-4 py-3 text-start min-w-50">Nama</th>
                        <th class="px-4 py-3 text-start min-w-40">Nomor Handphone</th>
                        <th class="px-4 py-3 text-center min-w-30">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-center min-w-50">Alamat</th>
                        <th class="px-4 py-3 text-center min-w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php
                        $halamanSekarang = request('page');
                        $i = empty($halamanSekarang) ? 1 : ($halamanSekarang * 10) - 9;
                    @endphp
                    @foreach($perawats as $item)
                    <tr class="bg-[#E3EBF3] hover:bg-[#d1e4f2] transition duration-200">
                        <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900">{{ $i }}</td>
                        <td class="px-4 py-2 text-gray-700">
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
                        <td class="whitespace-nowrap px-4 py-3 text-gray-700">{{ $item->nama }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-700">{{ $item->nomor_handphone }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-700">{{ $item->jenis_kelamin }}</td>
                        <td class="whitespace-nowrap px-4 py-3 text-gray-700">{{ $item->alamat }}</td>
                        
                        <td class="whitespace-nowrap px-4 py-3 flex space-x-2">
                            <a href="{{ route('admin.perawat.edit', $item->nomor_handphone) }}" class="bg-yellow-400 text-white px-2 py-1 rounded shadow hover:bg-yellow-500 flex items-center">
                                <i class="fa-solid fa-pen-to-square mr-2"></i>
                                Ubah
                            </a>
                            <form action="{{ route('admin.perawat.destroy', $item->id_user) }}" method="POST" style="display:inline;">
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
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $perawats->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/kelola-perawat.js') }}"></script>
@endpush
