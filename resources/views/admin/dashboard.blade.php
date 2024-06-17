@extends('layouts.main')

@section('container')
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67] dark:text-white">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white">Dashboard</h1>
    </div>
</div>

<hr class="border-1 border-[#B1B0AF] dark:border-[#4b5563] mb-4 mx-4">

<div class="flex flex-col lg:flex-row w-full p-4 space-y-6 lg:space-y-0 lg:space-x-6">
    <!-- Main Content -->
    <div class="flex-1">
        <div class="bg-[#222C67] dark:bg-gray-900 p-6 rounded-lg shadow-lg">
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

        <div class="mt-8">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold dark:text-white">Report</h3>
                    <select class="border-gray-300 rounded-md dark:bg-[#374151] dark:text-white">
                        <option>This Month</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 dark:bg-[#374151] p-4 rounded-lg flex flex-col items-center space-y-2 col-span-3">
                        <div class="text-4xl font-bold text-blue-800 dark:text-white">105</div>
                        <div>
                            <p class="text-gray-600 dark:text-[#c7d1d9] text-center">Total Pasien</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700 dark:text-white">Reservasi Hari ini</h2>
            </div>
        </div>
        <div class="relative w-full max-w-5xl mt-3">
            <div class="flex flex-col pb-5 px-5 rounded-xl bg-white dark:bg-gray-900 shadow-lg w-full overflow-x-auto pt-4 space-y-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative my-1 flex items-center justify-between">
                    <div class="relative">
                        <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-60 focus:ring-gray-200 bg-gray-100 dark:bg-gray-700" placeholder="Search for items">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21l-4.35-4.35M16.65 11.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="relative inline-block text-left">
                        <button id="options-button" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <a href="{{ route('index.antrian') }}" class="block text-sm text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-900 shadow-md">
                        <thead>
                            <tr>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">#</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Patient Name</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Gender</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Last Visit</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Diseases</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Report</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-2 text-gray-900 dark:text-gray-300">1</td>
                                <td class="py-2 text-gray-900 dark:text-gray-300">John Doe</td>
                                <td class="py-2 text-gray-900 dark:text-gray-300">Male</td>
                                <td class="py-2 text-gray-900 dark:text-gray-300">12/05/2016</td>
                                <td class="py-2"><span class="bg-red-200 text-red-800 dark:bg-red-800 dark:text-red-200 py-1 px-3 rounded-full text-xs">Fever</span></td>
                                <td class="py-2"><a href="#" class="text-blue-500 dark:text-blue-300"><i class="material-icons">picture_as_pdf</i></a></td>
                                <td class="py-2"><a href="#" class="text-blue-500 dark:text-blue-300">Details</a></td>
                            </tr>
                            <!-- Repeat the above tr for each row -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700 dark:text-white">Pasien</h2>
            </div>
        </div>
        <div class="relative w-full max-w-5xl mt-3">
            <div class="flex flex-col pb-5 px-5 rounded-xl bg-white dark:bg-gray-900 shadow-lg w-full overflow-x-auto pt-4">
                <label for="table-search-2" class="sr-only">Search</label>
                <div class="relative my-1 flex items-center justify-between">
                    <div class="relative">
                        <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-60 focus:ring-gray-200 bg-gray-100 dark:bg-gray-700" placeholder="Search for items">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21l-4.35-4.35M16.65 11.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="relative inline-block text-left">
                        <button id="options-button-2" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <a href="{{ route('perawat.data.pasien') }}" class="block text-sm text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-900 shadow-md">
                        <thead>
                            <tr>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">#</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Patient Name</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Gender</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Last Visit</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Diseases</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Report</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-2 text-gray-900 dark:text-gray-300">1</td>
                                <td class="py-2 text-gray-900 dark:text-gray-300">John Doe</td>
                                <td class="py-2 text-gray-900 dark:text-gray-300">Male</td>
                                <td class="py-2 text-gray-900 dark:text-gray-300">12/05/2016</td>
                                <td class="py-2"><span class="bg-red-200 text-red-800 dark:bg-red-800 dark:text-red-200 py-1 px-3 rounded-full text-xs">Fever</span></td>
                                <td class="py-2"><a href="#" class="text-blue-500 dark:text-blue-300"><i class="material-icons">picture_as_pdf</i></a></td>
                                <td class="py-2"><a href="#" class="text-blue-500 dark:text-blue-300">Details</a></td>
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
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6 dark:text-white">Patients Group</h2>
            <ul class="space-y-4">
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-orange-500 text-white mr-3">C</span>
                        <span class="dark:text-gray-300">Cholesterol</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">5 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-purple-500 text-white mr-3">D</span>
                        <span class="dark:text-gray-300">Diabetic</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">14 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-green-500 text-white mr-3">L</span>
                        <span class="dark:text-gray-300">Low Blood Pressure</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">10 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-teal-500 text-white mr-3">H</span>
                        <span class="dark:text-gray-300">Hypertension</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">21 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-blue-500 text-white mr-3">M</span>
                        <span class="dark:text-gray-300">Malaria</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">11 Patients</span>
                </li>
            </ul>
        </div>

        <div class="max-w-2xl mt-6 mx-auto bg-white dark:bg-gray-900 shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold mb-2 dark:text-white">Daftar Dokter</h2>
                    <div class="relative inline-block text-left">
                        <button id="options-button-3" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <a href="{{ route('perawat.index.dokter') }}" class="block text-sm text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mt-4">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Dokter</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-600">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-300">Dr. Jay Soni</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">MBBS, MD</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-300">Dr. Sarah Smith</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">BDS, MDS</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200">
                                        Absent
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-300">Dr. Megha Trivedi</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">BHMS</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">4</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-300">Dr. John Deo</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">MBBS, MS</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">5</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-300">Dr. Jacob Ryan</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">MBBS, MD</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200">
                                        Absent
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">6</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-300">Dr. Jay Soni</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">MBBS</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200">
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
