@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-300">
        <div class="flex items-center mb-6">
            <img src="{{ asset('assets/img/perawat.png') }}" class="w-24 h-24" alt="">
            <div class="ml-4">
                <p class="text-2xl md:text-3xl font-bold">Edit Jadwal Dokter</p>
                <p class="text-gray-500 text-md">Silahkan ubah formulir di bawah ini untuk mengubah jadwal dokter di sistem.</p>
            </div>
        </div>
        <form method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="flex flex-col items-center w-full">
                {{-- tidak ada foto --}}
                @if(!$dokter->foto)
                    <svg id="ikon-bawaan" class="w-2/5 h-2/5 md:w-52 md:h-52" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                {{-- ada foto --}}
                @else
                    <div id="div-foto-lama" class="w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 mb-4">
                        <img id="tampilkan-foto-lama" src="{{ asset('storage/' . $dokter->foto) }}" alt="foto-profil" class="object-cover object-top w-full h-full">
                    </div>
                @endif
                <p class="text-2xl font-semibold">{{ $dokter->nama }}</p>
            </div>
            <div class="flex flex-col w-full">
                <label for="senin">Senin</label>
                <select id="senin" name="senin" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih jam</option>
                    @php
                        $id = $jadwal->where('hari', 'Senin')->first();
                        if($id){
                            $id = $id->id_waktu;
                        }
                    @endphp
                    @foreach ($waktus->where('hari', 'Senin')->sortBy('jam') as $item)
                        <option value="{{ $item->id }}" {{ old('senin', $id) == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                    @endforeach
                </select>
                @error('senin')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="selasa">Selasa</label>
                <select id="selasa" name="selasa" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih jam</option>
                    @php
                        $id = $jadwal->where('hari', 'Selasa')->first();
                        if($id){
                            $id = $id->id_waktu;
                        }
                    @endphp
                    @foreach ($waktus->where('hari', 'Selasa')->sortBy('jam') as $item)
                        <option value="{{ $item->id }}" {{ old('selasa', $id) == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                    @endforeach
                </select>
                @error('selasa')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="rabu">Rabu</label>
                <select id="rabu" name="rabu" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih jam</option>
                    @php
                        $id = $jadwal->where('hari', 'Rabu')->first();
                        if($id){
                            $id = $id->id_waktu;
                        }
                    @endphp
                    @foreach ($waktus->where('hari', 'Rabu')->sortBy('jam') as $item)
                        <option value="{{ $item->id }}" {{ old('rabu', $id) == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                    @endforeach
                </select>
                @error('rabu')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="kamis">Kamis</label>
                <select id="kamis" name="kamis" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih jam</option>
                    @php
                        $id = $jadwal->where('hari', 'Kamis')->first();
                        if($id){
                            $id = $id->id_waktu;
                        }
                    @endphp
                    @foreach ($waktus->where('hari', 'Kamis')->sortBy('jam') as $item)
                        <option value="{{ $item->id }}" {{ old('kamis', $id) == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                    @endforeach
                </select>
                @error('kamis')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="jumat">Jumat</label>
                <select id="jumat" name="jumat" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih jam</option>
                    @php
                        $id = $jadwal->where('hari', 'Jumat')->first();
                        if($id){
                            $id = $id->id_waktu;
                        }
                    @endphp
                    @foreach ($waktus->where('hari', 'Jumat')->sortBy('jam') as $item)
                        <option value="{{ $item->id }}" {{ old('jumat', $id) == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                    @endforeach
                </select>
                @error('jumat')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="sabtu">Sabtu</label>
                <select id="sabtu" name="sabtu" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih jam</option>
                    @php
                        $id = $jadwal->where('hari', 'Sabtu')->first();
                        if($id){
                            $id = $id->id_waktu;
                        }
                    @endphp
                    @foreach ($waktus->where('hari', 'Sabtu')->sortBy('jam') as $item)
                        <option value="{{ $item->id }}" {{ old('sabtu', $id) == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                    @endforeach
                </select>
                @error('sabtu')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex flex-col w-full">
                <label for="minggu">Minggu</label>
                <select id="minggu" name="minggu" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="">Pilih jam</option>
                    @php
                        $id = $jadwal->where('hari', 'Minggu')->first();
                        if($id){
                            $id = $id->id_waktu;
                        }
                    @endphp
                    @foreach ($waktus->where('hari', 'Minggu')->sortBy('jam') as $item)
                        <option value="{{ $item->id }}" {{ old('minggu', $id) == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                    @endforeach
                </select>
                @error('minggu')
                    <div class="text-[#B42223] text-bold text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex justify-end mt-6">
                <button class="mr-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1"><i class="fa-solid fa-floppy-disk mr-2"></i>Ubah</button>
                <a href="{{ route('admin.index.dokter') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg py-2 px-4 w-min text-nowrap mt-1"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection