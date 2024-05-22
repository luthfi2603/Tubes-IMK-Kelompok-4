@extends('admin.main')

@section('container')
<div class="flex flex-col lg:flex-row w-full p-4 space-y-6 lg:space-y-0 lg:space-x-6">
    <!-- Main Content -->
    <div class="flex-1">
        <div class="bg-[#222C67] p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center">
                <div class="font-body text-white">
                    <h1 class="text-xl font-bold text-white py-2">Welcome back,</h1>
                    <h2 class="text-2xl font-semibold font-body text-white py-2">Dr Siti Nurhaji</h2>
                    <p class="text-white py-1">MD, DM (Cardiology), FACC, FESC</p>
                    <p class="pt-3 pb-1">You have total <span class="font-bold text-[#E8C51C]">12 Appointments</span> today!</p>
                </div>
                <div>
                    <img src="{{ asset('assets/img/female-doctor.png') }}" alt="Doctor Avatar" class="w-full h-40">
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Report</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="text-4xl font-bold text-blue-800">105</div>
                            <div>
                                <p class="text-gray-600">Total Patient</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-red-100 p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="text-4xl font-bold text-red-800">89</div>
                            <div>
                                <p class="text-gray-600">Consultation</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="text-4xl font-bold text-yellow-800">72</div>
                            <div>
                                <p class="text-gray-600">Rawat Inap & Jalan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700">Today's Appointment</h2>
            </div>
        </div>

        <div class="relative w-full max-w-5xl mt-3">
       
            <div class="flex flex-col pb-5 pt-2 px-3 rounded-xl bg-white shadow-lg w-full">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative my-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-40 bg-gray-100 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
            
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

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700">Patients</h2>
            </div>
        </div>

        <div class="relative w-full max-w-5xl mt-3">
       
            <div class="flex flex-col pb-5 pt-2 px-3 rounded-xl bg-white shadow-lg w-full">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative my-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-40 bg-gray-100 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
            
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

    


    <!-- Right Sidebar -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white p-6 rounded-lg shadow-lg">
          
        {{-- <div class="bg-white rounded-lg shadow-md p-6 w-80"> --}}
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
        </div>

        <div class="max-w-2xl mt-6 mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold mb-2">Doctors List</h2>
                    <div class="relative inline-block text-left">
                        <button id="options-button" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Options
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v2a1 1 0 11-2 0V4a1 1 0 011-1zm0 7a1 1 0 011 1v2a1 1 0 11-2 0v-2a1 1 0 011-1zm0 7a1 1 0 011 1v2a1 1 0 11-2 0v-2a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="options-menu" class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700">Add</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700">Delete</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700">Refresh</a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="min-w-full divide-y divide-gray-200 mt-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor Name</th>
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


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('patientsChart').getContext('2d');
    const ctx2 = document.getElementById('genderChart').getContext('2d');

    const patientsChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['0', '1', '2', '3', '4', '5', '6'],
            datasets: [
                {
                    label: 'This Week',
                    data: [105, 100, 120, 90, 85, 140, 160],
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    const genderChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Men', 'Women'],
            datasets: [
                {
                    label: 'Gender',
                    data: [170, 140],
                    backgroundColor: ['rgba(59, 130, 246, 1)', 'rgba(252, 165, 165, 1)'],
                },
            ],
        },
        options: {
            responsive: true,
        },
    });
</script>

<script>
    // Mengambil elemen tombol dan menu dropdown
    const optionsButton = document.getElementById('options-button');
    const optionsMenu = document.getElementById('options-menu');

    // Menambahkan event listener pada tombol
    optionsButton.addEventListener('click', () => {
        // Mengubah visibilitas menu dropdown
        optionsMenu.classList.toggle('hidden');
    });

    // Menyembunyikan menu dropdown ketika mengklik di luar area menu
    document.addEventListener('click', (event) => {
        if (!optionsButton.contains(event.target) && !optionsMenu.contains(event.target)) {
            optionsMenu.classList.add('hidden');
        }
    });
</script>

@endsection