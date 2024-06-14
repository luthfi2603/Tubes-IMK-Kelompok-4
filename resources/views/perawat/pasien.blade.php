@extends('perawat.main')

@section('container')
@if(session()->has('failed'))
    <div id="failed" class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg">
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-4 mx-4">
    <h1 class="text-3xl font-bold">Kelola Data Pasien</h1>
    <a href="{{ route('perawat.tambah.pasien') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center font-semibold">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Pasien
    </a>
</div>

<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">

<div class="mb-3 flex ml-5 justify-start items-center gap-4">
    <input type="text" id="cari-pasien" placeholder="Cari pasien..." class="rounded-lg" autofocus>
    <a id="tombol-tambah" class="hidden bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg h-min">Tambah</a>
</div>

<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="overflow-x-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-30">Foto</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-50">Nama</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Nomor Handphone</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Jenis Kelamin</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Alamat</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200" id="isi-tabel">
                @php
                    $currentPage = $users->currentPage();
                    $perPage = $users->perPage();
                    $totalItems = $users->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                @endphp
                @foreach($users as $item)
                    <tr class="bg-white hover:bg-[#d1e4f2] transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $startingNumber++ }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
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
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->pasien->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->nomor_handphone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->pasien->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->pasien->alamat }}</td>
                        <td class="px-4 pt-8  whitespace-nowrap text-md text-gray-900 flex space-x-2">
                            <div class="flex gap-2 items-center h-full">
                                <a href="{{ route('perawat.edit.pasien', $item->nomor_handphone) }}" class="bg-yellow-400 text-white px-2 py-1 rounded shadow hover:bg-yellow-500 flex items-center">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                    Ubah
                                </a>
                                @if ($item->aktif == 1)
                                    <form action="{{ route('perawat.ban.pasien', $item->nomor_handphone) }}" method="POST">
                                        @csrf
                                        <button class="bg-red-500 text-white px-2 py-1 rounded shadow hover:bg-red-600 flex items-center">
                                        <i class="fa-solid fa-ban mr-2"></i>
                                        Ban
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('perawat.unban.pasien', $item->nomor_handphone) }}" method="POST">
                                        @csrf
                                        <button class="bg-green-500 text-white px-2 py-1 rounded shadow hover:bg-green-600 flex items-center">
                                        <i class="fa-solid fa-unlock mr-2"></i>
                                        Unban
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4" id="pagination">
            {{ $users->links() }}
        </div>
    </div>
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/pasien.js') }}"></script>
@endpush
@endsection