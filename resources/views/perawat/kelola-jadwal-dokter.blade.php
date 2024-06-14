@extends('perawat.main')

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
<div class="flex justify-between items-center mb-4 mx-4">
    <h1 class="text-3xl font-bold">Kelola Jadwal Dokter</h1>
</div>

<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">

<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-30">Foto</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-50">Nama</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Spesialis</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-30">Hari</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-30">Jam</th>
                    {{-- jangan diubah ubah letak aksinya, harus selalu terakhir --}}
                </tr>
            </thead>
            <tbody id="isi-tabel">
                @if($jadwals->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center text-2xl py-3">
                            <div class="flex justify-center items-center">
                                <div class="bg-[#E3EBF3] text-center p-4 rounded-lg shadow-md font-bold w-3/4 flex items-center justify-center space-x-4">
                                    <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                                    <p class="text-xl text-[#222C67]">Belum ada Data</p>
                                    <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                                </div>
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
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $i }}</td>
                            
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