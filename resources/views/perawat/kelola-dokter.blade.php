@extends('perawat.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

    <div class="flex justify-between items-center mb-4 mx-4">
        <h1 class="text-3xl font-bold">Kelola Dokter</h1>
        
    </div>

    <hr class="border-1 border-[#B1B0AF] mb-4 mx-4">

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
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Spesialis</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Alamat</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Status</th>
                        {{-- tolong tambai status ya bang --}}
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
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Status</td>
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
        <div id="pagination">
            {{ $dokters->links() }}
        </div>
    
</div>

@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/kelola-dokter.js') }}"></script>
@endpush
@endsection