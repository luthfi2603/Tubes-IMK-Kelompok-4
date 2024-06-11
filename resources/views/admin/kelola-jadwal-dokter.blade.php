@extends('admin.main')

@section('container')
@if(session()->has('failed'))
    <div id="failed-php" class="mb-4 mx-4 bg-red-300 py-3 text-[#130D19] px-4 rounded-lg">
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div id="success-php" class="mb-4 mx-4 bg-green-300 py-3 text-[#130D19] px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Kelola Jadwal Dokter</h1>
    </div>
    <a href="{{ route('admin.jadwal.dokter.input') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Tambah</a>
</div>
<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">
<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Hari</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Jam</th>
                </tr>
            </thead>
            <tbody id="isi-tabel">
                @if($jadwals->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center text-2xl py-3">Data tidak ada</td>
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
                    @foreach ($jadwals as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $i }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.jadwal.dokter.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Ubah</a>
                                    <form action="{{ route('admin.jadwal.dokter.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">Hapus</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->hari }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $item->jam }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div id="pagination" class="mt-4">
        {{ $jadwals->links() }}
    </div>
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/kelola-jadwal-dokter.js') }}"></script>
@endpush
@endsection