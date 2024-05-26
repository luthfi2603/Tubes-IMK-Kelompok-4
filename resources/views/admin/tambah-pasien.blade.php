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
<div class="container mx-auto mt-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Tambah Pasien</h1>
        <form action="{{ route('admin.store.pasien') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="nomor_handphone" class="block text-gray-700 font-semibold mb-2">Nomor Handphone</label>
                <input type="text" name="nomor_handphone" id="nomor_handphone" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('nomor_handphone') }}" required>
                @error('nomor_handphone')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 font-semibold mb-2">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('alamat') }}" required>
                @error('alamat')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="pekerjaan" class="block text-gray-700 font-semibold mb-2">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('pekerjaan') }}" required>
                @error('pekerjaan')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-gray-700 font-semibold mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Tambah Pasien</button>
            </div>
        </form>
    </div>
</div>
@endsection
