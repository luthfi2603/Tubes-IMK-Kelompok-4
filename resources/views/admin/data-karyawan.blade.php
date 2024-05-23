@extends('admin.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h1 class="text-2xl font-bold mb-4">Daftar karyawan</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full  rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-800 text-sm font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-start">No</th>
                        <th class="px-4 py-3 text-start min-w-50">Nama</th>
                        <th class="px-4 py-3 text-start min-w-40">Nomor Telepon</th>
                        <th class="px-4 py-3 text-start min-w-50">Alamat</th>
                        <th class="px-4 py-3 text-start min-w-50">Jabatan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php
                        $currentPage = $karyawan->currentPage();
                        $perPage = $karyawan->perPage();
                        $totalItems = $karyawan->total();
                        $startingNumber = ($currentPage - 1) * $perPage + 1;
                    @endphp
                    @foreach($karyawan as $dataKaryawan)
                    <tr class="bg-[#E3EBF3]">
                        <td class="px-4 py-3">{{ $startingNumber++ }}</td>
                        <td class="px-4 py-3">{{ $dataKaryawan->nama }}</td>
                        <td class="px-4 py-3">{{ $dataKaryawan->nomor_handphone }}</td>
                        <td class="px-4 py-3">{{ $dataKaryawan->alamat }}</td>    
                        <td class="px-4 py-3">{{ $dataKaryawan->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $karyawan->links() }}
        </div>
    </div>
</div>
@endsection