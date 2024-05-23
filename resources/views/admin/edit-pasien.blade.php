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
<div class="section">
    <div class="container min-h-screen">
        <h3 class="text-3xl font-bold mb-6">Edit Data Pasien</h3>
        <div class="bg-white p-6 rounded-lg shadow-lg opacity-90">
            <form action="{{ route('admin.edit.pasien', $pasien->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="nama" class="block text-lg font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" id="nama" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('nama', $pasien->nama) }}">
                    @error('nama')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="nomor_handphone" class="block text-lg font-medium text-gray-700">Nomor Handphone</label>
                    <input type="text" name="nomor_handphone" id="nomor_handphone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('nomor_handphone', $pasien->nomor_handphone) }}">
                    @error('nomor_handphone')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="alamat" class="block text-lg font-medium text-gray-700">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('alamat', $pasien->alamat) }}">
                    @error('alamat')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="pekerjaan" class="block text-lg font-medium text-gray-700">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('pekerjaan', $pasien->pekerjaan) }}">
                    @error('pekerjaan')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col w-full">
                    <label class="font-semibold" for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="rounded-lg" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}">
                    @error('tanggal_lahir')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col w-full">
                    <label class="font-semibold" for="jenis_kelamin">Jenis Kelamin</label>
                    <div>
                        <input type="radio" id="L" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                        <label class="font-semibold mr-2" for="L">Laki-laki</label>
                        <input type="radio" id="P" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                        <label class="font-semibold" for="P">Perempuan</label>
                        @error('jenis_kelamin')
                            <div class="text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection