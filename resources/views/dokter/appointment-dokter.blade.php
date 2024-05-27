@extends('dokter.main')


@section('container')

<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Janji temu</h1>
    </div>
</div>

<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">

<div class="flex-1 p-6">
   
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded-lg text-center">
            <div class="text-3xl font-bold">105</div>
            <div>Total Patient</div>
        </div>
        <div class="bg-red-100 p-4 rounded-lg text-center">
            <div class="text-3xl font-bold">89</div>
            <div>Consultation</div>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg text-center">
            <div class="text-3xl font-bold">72</div>
            <div>Rawat Inap</div>
        </div>
        <div class="bg-green-100 p-4 rounded-lg text-center">
            <div class="text-3xl font-bold">89</div>
            <div>Rawat Jalan</div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="block w-full overflow-x-auto">
            <table class="min-w-full bg-white shadow-md">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Patient Name</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Umur</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Keluhan</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Time</th>
                        <th class="px-10 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="Avatar">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-blue-500">Sanath Deo La</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-center">
                            <span class="px-4 py-1 inline-flex text-md leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Male</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">18 Tahun</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">(+62) 895618689375</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Sesak pernafasan, Batuk</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">10:00 am - 11:00 am</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <button class="px-4 py-2 bg-green-100 text-green-800 rounded-lg">Success</button>
                        </td>   
                    </tr>
                    
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="Avatar">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-blue-500">Sanath Deo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-center">
                            <span class="px-4 py-1 inline-flex text-md leading-5 font-semibold rounded-full bg-red-100 text-red-800">Female</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">18 Tahun</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">(+62) 895618689375</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Sesak pernafasan, Batuk</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">10:00 am - 11:00 am</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <button class="px-4 py-2 bg-red-100 text-red-800 rounded-lg">Decline</button>
                        </td>           
                    </tr>

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="Avatar">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-blue-500">Sanath Deo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-center">
                            <span class="px-4 py-1 inline-flex text-md leading-5 font-semibold rounded-full bg-red-100 text-red-800">Female</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">18 Tahun</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">(+62) 895618689375</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Sesak pernafasan, Batuk</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">10:00 am - 11:00 am</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <button class="px-4 py-2 bg-green-100 text-green-800 rounded-lg">Success</button>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="Avatar">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-blue-500">Sanath Deo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-center">
                            <span class="px-4 py-1 inline-flex text-md leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Male</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">18 Tahun</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">(+62) 895618689375</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Sesak pernafasan, Batuk</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">10:00 am - 11:00 am</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <button class="px-4 py-2 bg-green-100 text-green-800 rounded-lg">Success</button>
                        </td>         
                    </tr>

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="Avatar">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-blue-500">Sanath Deo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-center">
                            <span class="px-4 py-1 inline-flex text-md leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Male</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">18 Tahun</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">(+62) 895618689375</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Sesak pernafasan, Batuk</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">10:00 am - 11:00 am</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <button class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg">Reschedule</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex items-center justify-between mt-4">
        <div>
            <label for="items-per-page" class="block text-md font-medium text-gray-700">Items per page:</label>
            <select id="items-per-page" name="items-per-page" class="mt-1 block w-16 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 md:text-md rounded-md">
                <option>5</option>
                <option>10</option>
                <option>15</option>
            </select>
        </div>
        <div class="flex-1 flex justify-end items-center space-x-2">
            <span class="text-md text-gray-700">1 - 7 of 16</span>
            <button class="px-3 py-1 bg-gray-300 text-gray-700 rounded-lg">Previous</button>
            <button class="px-3 py-1 bg-gray-300 text-gray-700 rounded-lg">Next</button>
        </div>
    </div>
</div>

    <script>
    function updateSelectClass(select) {
        select.classList.remove('bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800', 'bg-yellow-100', 'text-yellow-800');
        if (select.value === 'success') {
            select.classList.add('bg-green-100', 'text-green-800');
        } else if (select.value === 'decline') {
            select.classList.add('bg-red-100', 'text-red-800');
        } else if (select.value === 'reschedule') {
            select.classList.add('bg-yellow-100', 'text-yellow-800');
        }
    }
</script>

@endsection
