@extends('layouts.main')

@section('container')
<div class="flex flex-col lg:flex-row w-full p-4 space-y-6 lg:space-y-0 lg:space-x-6">
    <!-- Main Content -->
    <div class="flex-1">
        <div class="bg-[#222C67] p-6 rounded-lg shadow-lg">
            <div class="flex flex-col md:flex-row justify-between items-center max-[760px]:items-start">
                <div class="font-body text-white mb-4 md:mb-0">
                    <h1 class="text-xl font-bold text-white py-2">Welcome back,</h1>
                    <h2 class="text-2xl font-semibold font-body text-white pt-2 pb-1">Siti Nurhaji</h2>
                    <p class="text-white">Perawat</p>
                    <p class="pt-3 pb-1">Hari ini terdapat<span class="font-bold text-[#E8C51C]"> 12 Reservasi</span></p>
                </div>
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/img/perawat.png') }}" alt="Doctor Avatar" class="w-full h-40 lg:block md:block max-[760px]:hidden">
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Report</h3>
                    <select class="border-gray-300 rounded-lg">
                        <option>This Month</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 p-4 rounded-lg flex flex-col items-center space-y-2 col-span-3">
                        <div class="text-4xl font-bold text-blue-800">105</div>
                        <div>
                            <p class="text-gray-600 text-center">Total Pasien</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700">Reservasi Hari ini</h2>
            </div>
        </div>
        <div class="relative w-full max-w-5xl mt-3">
    <div class="flex flex-col pb-5 px-5 rounded-xl bg-white shadow-lg w-full overflow-x-auto pt-4 space-y-4">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative my-1 flex items-center justify-between">
            <div class="relative">
                <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-60 focus:ring-gray-200 bg-gray-100" placeholder="Search for items">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21l-4.35-4.35M16.65 11.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <div class="relative inline-block text-left">
                <button id="options-button" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <a href="{{ route('index.antrian') }}" class="block text-sm text-gray-700">
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 text-left text-gray-600">#</th>
                        <th class="py-2 text-left text-gray-600">Patient Name</th>
                        <th class="py-2 text-left text-gray-600">Gender</th>
                        <th class="py-2 text-left text-gray-600">Last Visit</th>
                        <th class="py-2 text-left text-gray-600">Diseases</th>
                        <th class="py-2 text-left text-gray-600">Report</th>
                        <th class="py-2 text-left text-gray-600">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2">1</td>
                        <td class="py-2">John Doe</td>
                        <td class="py-2">Male</td>
                        <td class="py-2">12/05/2016</td>
                        <td class="py-2"><span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs">Fever</span></td>
                        <td class="py-2"><a href="#" class="text-blue-500"><i class="material-icons">picture_as_pdf</i></a></td>
                        <td class="py-2"><a href="#" class="text-blue-500">Details</a></td>
                    </tr>
                    <!-- Repeat the above tr for each row -->
                </tbody>
            </table>
        </div>
    </div>
</div>


        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700">Pasien</h2>
            </div>
        </div>
        <div class="relative w-full max-w-5xl mt-3">
            <div class="flex flex-col pb-5 px-5 rounded-xl bg-white shadow-lg w-full overflow-x-auto pt-4">
                <label for="table-search-2" class="sr-only">Search</label>
                <div class="relative my-1 flex items-center justify-between">
                    <div class="relative">
                        <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-60 focus:ring-gray-200 bg-gray-100" placeholder="Search for items">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21l-4.35-4.35M16.65 11.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="relative inline-block text-left">
                        <button id="options-button-2" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <a href="{{ route('perawat.data.pasien') }}" class="block text-sm text-gray-700">
                                {{-- <span class="hidden md:inline">Lihat lebih lanjut</span> --}}
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md">
                        <thead>
                            <tr>
                                <th class="py-2 text-left text-gray-600 tracking-wider">#</th>
                                <th class="py-2 text-left text-gray-600 tracking-wider">Patient Name</th>
                                <th class="py-2 text-left text-gray-600 tracking-wider">Gender</th>
                                <th class="py-2 text-left text-gray-600 tracking-wider">Last Visit</th>
                                <th class="py-2 text-left text-gray-600 tracking-wider">Diseases</th>
                                <th class="py-2 text-left text-gray-600 tracking-wider">Report</th>
                                <th class="py-2 text-left text-gray-600 tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 whitespace-nowrap text-md">1</td>
                                <td class="py-2 whitespace-nowrap text-md">John Doe</td>
                                <td class="py-2 whitespace-nowrap text-md">Male</td>
                                <td class="py-2 whitespace-nowrap text-md">12/05/2016</td>
                                <td class="py-2 whitespace-nowrap text-md"><span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs">Fever</span></td>
                                <td class="py-2 whitespace-nowrap text-md"><a href="#" class="text-blue-500"><i class="material-icons">picture_as_pdf</i></a></td>
                                <td class="py-2 whitespace-nowrap text-md"><a href="#" class="text-blue-500">Details</a></td>
                            </tr>
                            <!-- Repeat the above tr for each row -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Patients Group</h2>
            <ul class="space-y-4">
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-orange-500 text-white mr-3">C</span>
                        <span>Cholesterol</span>
                    </div>
                    <span class="text-gray-500">5 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-purple-500 text-white mr-3">D</span>
                        <span>Diabetic</span>
                    </div>
                    <span class="text-gray-500">14 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-green-500 text-white mr-3">L</span>
                        <span>Low Blood Pressure</span>
                    </div>
                    <span class="text-gray-500">10 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-teal-500 text-white mr-3">H</span>
                        <span>Hypertension</span>
                    </div>
                    <span class="text-gray-500">21 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-blue-500 text-white mr-3">M</span>
                        <span>Malaria</span>
                    </div>
                    <span class="text-gray-500">11 Patients</span>
            </li>
            </ul>
        </div>

        <div class="max-w-2xl mt-6 mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold mb-2">Daftar Dokter</h2>
                    <div class="relative inline-block text-left">
                        <button id="options-button-3" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <a href="{{ route('perawat.index.dokter') }}" class="block text-sm text-gray-700">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dokter</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">1</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. Jay Soni</div>
                                            <div class="text-sm text-gray-500">MBBS, MD</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">2</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. Sarah Smith</div>
                                            <div class="text-sm text-gray-500">BDS, MDS</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Absent
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">3</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. Megha Trivedi</div>
                                            <div class="text-sm text-gray-500">BHMS</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">4</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. John Deo</div>
                                            <div class="text-sm text-gray-500">MBBS, MS</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">5</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. Jacob Ryan</div>
                                            <div class="text-sm text-gray-500">MBBS, MD</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Absent
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">6</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Dr. Jay Soni</div>
                                            <div class="text-sm text-gray-500">MBBS</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Available
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
