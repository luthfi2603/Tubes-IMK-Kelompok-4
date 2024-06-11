@extends('admin.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg">
        {{ session('failed') }}
    </div>
@endif
<div class="flex flex-col gap-4">
    <p class="text-2xl md:text-3xl font-bold">Tambah Jadwal Dokter</p>
    <form action="{{ route('admin.jadwal.dokter.edit', $jadwalDokter->id) }}" method="POST" class="flex justify-center">
        @csrf
        @method('PUT')
        <div class="flex flex-col items-center gap-4 w-1/2">
            <div class="flex flex-col w-full">
                <label for="hari">Hari</label>
                <select id="hari" name="hari" class="px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih Hari</option>
                    <option {{ old('hari', $jadwalDokter->hari) === 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option {{ old('hari', $jadwalDokter->hari) === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option {{ old('hari', $jadwalDokter->hari) === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option {{ old('hari', $jadwalDokter->hari) === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option {{ old('hari', $jadwalDokter->hari) === 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option {{ old('hari', $jadwalDokter->hari) === 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option {{ old('hari', $jadwalDokter->hari) === 'Minggu' ? 'selected' : '' }}>Minggu</option>
                </select>
                @error('hari')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="jam">Jam</label>
                <input type="text" name="jam" id="jam" placeholder="Masukkan jam yang valid, 08:00-13:00" class="rounded-lg" value="{{ old('jam', $jadwalDokter->jam) }}">
                @error('jam')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <button class="mr-2 bg-green-500 hover:bg-green-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1">Ubah</button>
                <a href="{{ route('admin.jadwal.dokter.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection