{{-- @extends('admin.main')

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
    <p class="text-2xl md:text-3xl font-bold">Ubah Data Perawat</p>
    <form action="{{ route('admin.perawat.edit', $perawat->id_user) }}" method="POST" enctype="multipart/form-data" class="flex justify-center">
        @csrf
        @method('PUT')
        <input type="hidden" name="foto_lama" id="foto_lama" value="{{ $perawat->foto }}">
        <input type="hidden" name="hapus" id="hapus">
        <div class="flex flex-col items-center gap-4 w-1/2">
            <div class="flex flex-col items-center w-full"> --}}
                {{-- tidak ada foto --}}
                {{-- @if(!$perawat->foto)
                    <svg id="ikon-bawaan" class="w-2/5 h-2/5 md:w-52 md:h-52" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                    <div id="div-foto" class="hidden w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 mb-4">
                        <img id="tampilkan-foto" alt="foto-profil" class="object-cover object-top w-full h-full">
                    </div>
                    <div class="flex gap-2">
                        <button id="tombol-pilih-foto" type="button" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Pilih Foto</button>
                        <button id="tombol-hapus-foto-tidak-ada-foto" type="button" class="hidden bg-red-500 hover:bg-red-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Hapus Foto</button>
                    </div> --}}
                {{-- ada foto --}}
                {{-- @else
                    <svg id="ikon-bawaan" class="hidden w-2/5 h-2/5 md:w-52 md:h-52" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                    <div id="div-foto-lama" class="w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 mb-4">
                        <img id="tampilkan-foto-lama" src="{{ asset('storage/' . $perawat->foto) }}" alt="foto-profil" class="object-cover object-top w-full h-full">
                    </div>
                    <div id="div-foto" class="hidden w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 mb-4">
                        <img id="tampilkan-foto" alt="foto-profil" class="object-cover object-top w-full h-full">
                    </div>
                    <div class="flex gap-2">
                        <button id="tombol-pilih-foto" type="button" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Pilih Foto</button>
                        <button id="tombol-hapus-foto" type="button" class="bg-red-500 hover:bg-red-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Hapus Foto</button>
                        <button id="tombol-batal" type="button" class="hidden bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Batal</button>
                    </div>
                @endif
                <input type="file" name="foto" id="foto" class="hidden">
                <div id="error-message" class="text-[#B42223] text-bold text-sm w-full"></div>
                @error('foto')
                    <div class="text-[#B42223] text-bold text-sm w-full">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap" class="rounded-lg" value="{{ old('nama', $perawat->nama) }}" autofocus>
                @error('nama')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="nomor_handphone">Nomor Handphone</label>
                <input type="number" name="nomor_handphone" id="nomor_handphone" placeholder="Masukkan nomor handphone" class="rounded-lg" value="{{ old('nomor_handphone', $perawat->nomor_handphone) }}">
                @error('nomor_handphone')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="rounded-lg" value="{{ old('alamat', $perawat->alamat) }}">
                @error('alamat')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <p class="font-semibold">Jenis Kelamin</p>
                <div>
                    <input type="radio" id="L" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                    <label class="font-semibold mr-2" for="L">Laki-laki</label>
                    <input type="radio" id="P" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                    <label class="font-semibold" for="P">Perempuan</label>
                    @error('jenis_kelamin')
                        <div class="text-[#B42223] text-bold text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="flex flex-col w-full relative">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" placeholder="Masukkan kata sandi" class="rounded-lg">
                <i class="fa-solid fa-eye absolute right-3 top-9 cursor-pointer text-[#222c67]" id="toggle-password"></i>
                @error('password')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full relative">
                <label for="konfirmasi_password">Konfirmasi Kata Sandi</label>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Masukkan konfirmasi kata sandi" class="rounded-lg">
                <i class="fa-solid fa-eye absolute right-3 top-9 cursor-pointer text-[#222c67]" id="toggle-password-2"></i>
                @error('konfirmasi_password')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <button class="mr-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1">Ubah</button>
                <a href="{{ route('admin.perawat.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1">Kembali</a>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script src="{{ asset('assets/js/edit-perawat.js') }}"></script>
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
@endpush
@endsection --}}

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

<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-300">
        <div class="flex items-center mb-6">
            <img src="{{ asset('assets/img/perawat.png') }}" class="w-24 h-24" alt="">
            <div class="ml-4">
                <p class="text-2xl md:text-3xl font-bold">Edit Perawat</p>
                <p class="text-gray-500 text-md">Silahkan ubah formulir di bawah ini untuk mengubah data diri perawat di sistem.</p>
            </div>
        </div>
        <form action="{{ route('admin.perawat.edit', $perawat->id_user) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <input type="hidden" name="foto_lama" id="foto_lama" value="{{ $perawat->foto }}">
        <input type="hidden" name="hapus" id="hapus">
        <div class="flex flex-col items-center w-full">
            {{-- tidak ada foto --}}
            @if(!$perawat->foto)
                <svg id="ikon-bawaan" class="w-2/5 h-2/5 md:w-52 md:h-52" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                <div id="div-foto" class="hidden w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 mb-4">
                    <img id="tampilkan-foto" alt="foto-profil" class="object-cover object-top w-full h-full">
                </div>
                <div class="flex gap-2">
                    <button id="tombol-pilih-foto" type="button" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Pilih Foto</button>
                    <button id="tombol-hapus-foto-tidak-ada-foto" type="button" class="hidden bg-red-500 hover:bg-red-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Hapus Foto</button>
                </div>
            {{-- ada foto --}}
            @else
                <svg id="ikon-bawaan" class="hidden w-2/5 h-2/5 md:w-52 md:h-52" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                <div id="div-foto-lama" class="w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 mb-4">
                    <img id="tampilkan-foto-lama" src="{{ asset('storage/' . $perawat->foto) }}" alt="foto-profil" class="object-cover object-top w-full h-full">
                </div>
                <div id="div-foto" class="hidden w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 mb-4">
                    <img id="tampilkan-foto" alt="foto-profil" class="object-cover object-top w-full h-full">
                </div>
                <div class="flex gap-2">
                    <button id="tombol-pilih-foto" type="button" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Pilih Foto</button>
                    <button id="tombol-hapus-foto" type="button" class="bg-red-500 hover:bg-red-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Hapus Foto</button>
                    <button id="tombol-batal" type="button" class="hidden bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Batal</button>
                </div>
            @endif
            <input type="file" name="foto" id="foto" class="hidden">
            <div id="error-message" class="text-[#B42223] text-bold text-sm w-full mt-4"></div>
            @error('foto')
                <div class="text-[#B42223] text-bold text-sm w-full mt-4">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Masukkan nama lengkap" value="{{ old('nama', $perawat->nama) }}" autofocus>
            @error('nama')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="nomor_handphone" class="block text-gray-700 font-semibold mb-2">Nomor Handphone</label>
            <input type="number" name="nomor_handphone" id="nomor_handphone" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Masukkan nomor handphone" value="{{ old('nomor_handphone', $perawat->nomor_handphone) }}">
            @error('nomor_handphone')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="alamat" class="block text-gray-700 font-semibold mb-2">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Masukkan alamat" value="{{ old('alamat', $perawat->alamat) }}">
            @error('alamat')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <p class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</p>
            <div class="flex items-center">
                <input type="radio" id="L" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'L' ? 'checked' : '' }} class="mr-2">
                <label for="L" class="mr-4">Laki-laki</label>
                <input type="radio" id="P" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'P' ? 'checked' : '' }} class="mr-2">
                <label for="P">Perempuan</label>
            </div>
            @error('jenis_kelamin')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Kata Sandi</label>
            <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Masukkan kata sandi">
            <i class="fa-solid fa-eye absolute right-3 top-9 cursor-pointer text-gray-500" id="toggle-password"></i>
            @error('password')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="konfirmasi_password" class="block text-gray-700 font-semibold mb-2">Konfirmasi Kata Sandi</label>
            <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Masukkan konfirmasi kata sandi">
            <i class="fa-solid fa-eye absolute right-3 top-9 cursor-pointer text-gray-500" id="toggle-password-2"></i>
            @error('konfirmasi_password')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 mr-2">Ubah</button>
            <a href="{{ route('admin.perawat.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg py-2 px-4">Kembali</a>
        </div>
    </form>
</div>  
</div>

@push('scripts')
    <script src="{{ asset('assets/js/edit-perawat.js') }}"></script>
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
@endpush
@endsection
