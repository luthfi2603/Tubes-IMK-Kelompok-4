@extends('admin.main')

@section('container')
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
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Foto</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Nama</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Nomor Handphone</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Jenis Kelamin</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Alamat</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-start">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
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
                            <td class="px-4 py-2 text-gray-700">
                                @if($item->foto)
                                    <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="perawat" class="object-cover object-top w-full h-full">
                                    </div>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $item->nama }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $item->nomor_handphone }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $item->jenis_kelamin }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $item->alamat }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <a href="{{ route('admin.perawat.edit', $item->nomor_handphone) }}">Ubah</a>
                                <form action="{{ route('admin.perawat.destroy', $item->id_user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection