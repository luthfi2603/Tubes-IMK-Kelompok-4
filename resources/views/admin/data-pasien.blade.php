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
    <div class="col-lg-12 pt-3">
        <h1 class="text-2xl font-bold mb-4">Daftar Pasien</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full  rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-800 text-sm font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-start">No</th>
                        <th class="px-4 py-3 text-start min-w-50">Nama</th>
                        <th class="px-4 py-3 text-start min-w-40">Nomor Telepon</th>
                        <th class="px-4 py-3 text-start min-w-50">Alamat</th>
                        <th class="px-4 py-3 text-start min-w-30">Janji Temu Selanjutnya</th>
                        <th class="px-4 py-3 text-start min-w-30">Janji Temu Terakhir</th>
                        <th class="px-4 py-3 text-start min-w-30">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php
                        $currentPage = $pasien->currentPage();
                        $perPage = $pasien->perPage();
                        $totalItems = $pasien->total();
                        $startingNumber = ($currentPage - 1) * $perPage + 1;
                    @endphp
                    @foreach($pasien as $datapasien)
                    <tr class="bg-[#E3EBF3]">
                        <td class="px-4 py-3">{{ $startingNumber++ }}</td>
                        <td class="px-4 py-3">{{ $datapasien->nama }}</td>
                        <td class="px-4 py-3">{{ $datapasien->nomor_handphone }}</td>
                        <td class="px-4 py-3">{{ $datapasien->alamat }}</td> 
                        <td></td>          
                        <td></td>
                        <td><a href="{{ route('admin.edit.pasien', $datapasien->nomor_handphone) }}">Edit</a>
                            
                            @if ($datapasien->aktif == 1)
                                <form action="{{ route('admin.ban.pasien', $datapasien->nomor_handphone) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="text-red-500">Ban</button>
                                </form>
                            @else
                                <form action="{{ route('admin.unban.pasien', $datapasien->nomor_handphone) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="text-green-500">Unban</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pasien->links() }}
        </div>
    </div>
</div>
@endsection