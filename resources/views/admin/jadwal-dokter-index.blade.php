@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] dark:bg-green-900 text-[#0f5132] dark:text-green-300 border-2 border-[#badbcc] dark:border-green-700 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] dark:bg-red-900 text-[#842029] dark:text-red-300 border-2 border-[#f5c2c7] dark:border-red-700 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div class="flex justify-between items-center mb-4 mx-4">
    <h1 class="text-3xl font-bold text-[#222c67] dark:text-white dark:text-white">Kelola Jadwal Dokter</h1>
    <a href="{{ route('admin.jadwal.dokter.input') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Jadwal Dokter
    </a>
</div>

<hr class="border-1 border-[#B1B0AF] dark:border-[#4b5563] mb-4 mx-4">

<div class="container mx-auto p-4">
    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-900">
            <thead>
                <tr>
                    <th class="px-3 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">No</th>
                    <th class="px-3 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Aksi</th> 
                    <th class="px-3 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Hari</th>
                    <th class="px-3 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-700 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Jam</th>
                </tr>
            </thead>
            <tbody id="isi-tabel" class="divide-y divide-gray-200 dark:divide-gray-700">
                @if($jadwals->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-2xl py-3">
                            <div class="bg-gray-100 dark:bg-gray-900 rounded-lg p-4 inline-flex items-center text-gray-500 dark:text-gray-300">
                                <i class="fa-regular fa-file mr-3"></i>  
                                <span class="text-lg font-semibold">Data tidak ada</span>
                            </div>
                        </td>
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
                        <tr class="hover:bg-[#d1e4f2] dark:hover:bg-gray-700 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">{{ $i }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.jadwal.dokter.edit', $item->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded shadow hover:bg-yellow-500 flex items-center">
                                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                                        Ubah
                                    </a>
                                    <form onsubmit="hapusJadwalDokter(event)" action="{{ route('admin.jadwal.dokter.destroy', $item->id) }}" method="POST">
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
                            <td class="px-3 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">{{ $item->hari }}</td>
                            <td class="px-3 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">{{ $item->jam }}</td>
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
