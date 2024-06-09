@extends('dokter.main')

@section('container')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#222C67]">Detail Rekam Medis</h1>
        <a href="{{ route('dokter.rekam.medis') }}" class="bg-[#E8C51C] hover:bg-[#d3da78] font-semibold text-gray-700 px-4 py-2 rounded-full shadow-md transition duration-300">Kembali</a>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col items-center">
            <div class="flex w-full">
                <div class="w-1/5">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
                </div>
                <div class="flex flex-col items-center w-3/5">
                    <p>Dr. dr. Lorem Ipsum Dolor Sit Amet</p>
                    <p>Obgyn</p>
                    <p>RH61 Clinic, Jl. Ringroad (Jl. Gagak Hitam)</p>
                    <p>Komplek Ruko OCBC No. 61, Medan</p>
                    <p>Telp. (061) 42081004 - 42081005 HP. 08116176661</p>
                </div>
                <div class="w-1/5">Jam Hadir : 10:00</div>
            </div>
            <p class="underline">Kartu Berobat</p>
            <div class="flex w-full">
                <div class="w-1/2 flex flex-col">
                    <div class="flex">
                        <div class="w-4/12">
                            No.
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            1
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-4/12">
                            Nama
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            Lorem Ipsum Dolor
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-4/12">
                            Umur
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            20
                        </div>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col">
                    <div class="flex">
                        <div class="w-4/12">
                            Pekerjaan
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            Mahasiswa
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-4/12">
                            Alamat
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            Jalan Dr. Mansyur
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-4/12">
                            Nomor Handphone
                        </div>
                        <div class="w-1/12">
                            :
                        </div>
                        <div class="w-8/12">
                            081232124587
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="w-full">
                <p>Tanggal : 08 Juni 2024</p>
            </div>
            <table class="border-4 border-black">
                <thead>
                    <tr>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Therapie</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-4">In quis mollit non anim consequat nostrud aliqua excepteur occaecat exercitation labore dolor excepteur duis. Mollit velit ea labore nisi ipsum ipsum in ex minim exercitation. Sunt pariatur enim anim consequat cillum commodo eu proident esse laboris eu nostrud esse. Officia sint est fugiat sint anim nulla Lorem mollit adipisicing reprehenderit reprehenderit pariatur. Adipisicing deserunt esse magna fugiat Lorem excepteur incididunt reprehenderit consequat laborum eu enim sint qui. Est exercitation exercitation voluptate sunt veniam. Irure aliquip ad ea reprehenderit minim nulla labore.</td>
                        <td class="p-4">In quis mollit non anim consequat nostrud aliqua excepteur occaecat exercitation labore dolor excepteur duis. Mollit velit ea labore nisi ipsum ipsum in ex minim exercitation. Sunt pariatur enim anim consequat cillum commodo eu proident esse laboris eu nostrud esse. Officia sint est fugiat sint anim nulla Lorem mollit adipisicing reprehenderit reprehenderit pariatur. Adipisicing deserunt esse magna fugiat Lorem excepteur incididunt reprehenderit consequat laborum eu enim sint qui. Est exercitation exercitation voluptate sunt veniam. Irure aliquip ad ea reprehenderit minim nulla labore.</td>
                        <td class="p-4">In quis mollit non anim consequat nostrud aliqua excepteur occaecat exercitation labore dolor excepteur duis. Mollit velit ea labore nisi ipsum ipsum in ex minim exercitation. Sunt pariatur enim anim consequat cillum commodo eu proident esse laboris eu nostrud esse. Officia sint est fugiat sint anim nulla Lorem mollit adipisicing reprehenderit reprehenderit pariatur. Adipisicing deserunt esse magna fugiat Lorem excepteur incididunt reprehenderit consequat laborum eu enim sint qui. Est exercitation exercitation voluptate sunt veniam. Irure aliquip ad ea reprehenderit minim nulla labore.</td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="flex w-full">
                <div class="w-1/3 flex flex-col">
                    <p class="border-4">Keluhan</p>
                    <p>
                        In quis mollit non anim consequat nostrud aliqua excepteur occaecat exercitation labore dolor excepteur duis. Mollit velit ea labore nisi ipsum ipsum in ex minim exercitation. Sunt pariatur enim anim consequat cillum commodo eu proident esse laboris eu nostrud esse. Officia sint est fugiat sint anim nulla Lorem mollit adipisicing reprehenderit reprehenderit pariatur. Adipisicing deserunt esse magna fugiat Lorem excepteur incididunt reprehenderit consequat laborum eu enim sint qui. Est exercitation exercitation voluptate sunt veniam. Irure aliquip ad ea reprehenderit minim nulla labore.
                    </p>
                </div>
                <div class="w-1/3 flex flex-col">
                    <p class="border-4">Diagnosa</p>
                    <p>
                        In quis mollit non anim consequat nostrud aliqua excepteur occaecat exercitation labore dolor excepteur duis. Mollit velit ea labore nisi ipsum ipsum in ex minim exercitation. Sunt pariatur enim anim consequat cillum commodo eu proident esse laboris eu nostrud esse. Officia sint est fugiat sint anim nulla Lorem mollit adipisicing reprehenderit reprehenderit pariatur. Adipisicing deserunt esse magna fugiat Lorem excepteur incididunt reprehenderit consequat laborum eu enim sint qui. Est exercitation exercitation voluptate sunt veniam. Irure aliquip ad ea reprehenderit minim nulla labore.
                    </p>
                </div>
                <div class="w-1/3 flex flex-col">
                    <p class="border-4">Therapie</p>
                    <p>
                        In quis mollit non anim consequat nostrud aliqua excepteur occaecat exercitation labore dolor excepteur duis. Mollit velit ea labore nisi ipsum ipsum in ex minim exercitation. Sunt pariatur enim anim consequat cillum commodo eu proident esse laboris eu nostrud esse. Officia sint est fugiat sint anim nulla Lorem mollit adipisicing reprehenderit reprehenderit pariatur. Adipisicing deserunt esse magna fugiat Lorem excepteur incididunt reprehenderit consequat laborum eu enim sint qui. Est exercitation exercitation voluptate sunt veniam. Irure aliquip ad ea reprehenderit minim nulla labore.
                    </p>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection