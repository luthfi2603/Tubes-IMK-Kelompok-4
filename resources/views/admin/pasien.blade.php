@extends('admin.main')

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
<div class="container">
    <div class="mb-4 flex justify-center items-center gap-4">
        <input type="text" id="cari-pasien" placeholder="Cari pasien..." class="rounded-lg" autofocus>
        <a id="tombol-tambah" class="hidden bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg h-min">Tambah</a>
    </div>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold mb-0">Daftar Pasien</h1>
        <p class="mb-0">
            <a href="{{ route('admin.tambah.pasien') }}" class="font-bold text-blue-500 hover:underline">Tambah Pasien</a>
        </p>
    </div>  
    <div class="overflow-x-auto">
        <table class="min-w-full  rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-800 text-sm font-semibold">
                <tr>
                    <th class="px-4 py-3 text-start">#</th>
                    <th class="px-4 py-3 text-start min-w-30">Aksi</th>
                    <th class="px-4 py-3 text-start min-w-30">Foto</th>
                    <th class="px-4 py-3 text-start min-w-50">Nama</th>
                    <th class="px-4 py-3 text-start min-w-40">Nomor Handphone</th>
                    <th class="px-4 py-3 text-start min-w-40">Jenis Kelamin</th>
                    <th class="px-4 py-3 text-start min-w-50">Alamat</th>
                </tr>
            </thead>
            <tbody class="text-gray-700" id="isi-tabel">
                @php
                    $currentPage = $users->currentPage();
                    $perPage = $users->perPage();
                    $totalItems = $users->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                @endphp
                @foreach($users as $item)
                    <tr class="bg-[#E3EBF3]">
                        <td class="px-4 py-3">{{ $startingNumber++ }}</td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.edit.pasien', $item->nomor_handphone) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Edit</a>
                                @if ($item->aktif == 1)
                                    <form action="{{ route('admin.ban.pasien', $item->nomor_handphone) }}" method="POST">
                                        @csrf
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">Ban</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.unban.pasien', $item->nomor_handphone) }}" method="POST">
                                        @csrf
                                        <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg">Unban</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        <td>
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
                        <td class="px-4 py-3">{{ $item->pasien->nama }}</td>
                        <td class="px-4 py-3">{{ $item->nomor_handphone }}</td>
                        <td class="px-4 py-3">{{ $item->pasien->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                        <td class="px-4 py-3">{{ $item->pasien->alamat }}</td>
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