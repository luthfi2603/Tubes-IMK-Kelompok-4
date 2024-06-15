@extends('layouts.main')

@section('container')

<div class="container mx-auto p-6">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold mb-6 text-[#222C67] dark:text-gray-100">Settings</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Customize Settings -->
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 bg-white dark:bg-gray-800 shadow-sm">
                <h3 class="text-xl font-bold mb-4 text-[#222C67]">Customize Settings</h3>
                <div class="mb-4">
                    <label for="font" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Font</label>
                    <select id="font" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full">
                        <option>Arial</option>
                        <option>Times New Roman</option>
                        <option>Verdana</option>
                        <option>Helvetica</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="font-size" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Font Size</label>
                    <input type="number" id="font-size" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" placeholder="16">
                </div>
                <div class="mb-4 flex items-center">
                    <label for="dark-mode" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dark Mode</label>
                    <div class="ml-2 relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" id="dark-mode" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" onclick="toggleDarkMode()"/>
                        <label for="dark-mode" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 dark:bg-gray-700 cursor-pointer"></label>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 bg-white dark:bg-gray-800 shadow-sm">
                <h3 class="text-xl font-bold mb-4 text-[#222C67]">Personal Information</h3>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                    <input type="text" id="name" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" placeholder="Dr. John Doe">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" id="email" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" placeholder="john.doe@example.com">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                    <input type="text" id="phone" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" placeholder="123-456-7890">
                </div>
                <div class="mb-4">
                    <label for="specialization" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Specialization</label>
                    <input type="text" id="specialization" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" placeholder="Dermatology">
                </div>
            </div>

            <!-- Appointment Settings -->
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 bg-white dark:bg-gray-800 shadow-sm">
                <h3 class="text-xl font-bold mb-4 text-[#222C67]">Appointment Settings</h3>
                <div class="mb-4">
                    <label for="availability" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Availability</label>
                    <input type="text" id="availability" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" placeholder="Mon - Fri, 9:00 AM - 5:00 PM">
                </div>
                <div class="mb-4">
                    <label for="appointment-duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Appointment Duration</label>
                    <input type="number" id="appointment-duration" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full" placeholder="30 minutes">
                </div>
            </div>

            <!-- Password Settings -->
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 bg-white dark:bg-gray-800 shadow-sm">
                <h3 class="text-xl font-bold mb-4 text-[#222C67]">Change Password</h3>
                <div class="mb-4">
                    <label for="current-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                    <input type="password" id="current-password" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full">
                </div>
                <div class="mb-4">
                    <label for="new-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                    <input type="password" id="new-password" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full">
                </div>
                <div class="mb-4">
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New Password</label>
                    <input type="password" id="confirm-password" class="mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-md w-full">
                </div>
            </div>
        </div>
        <div class="mt-8">
            <button class="bg-[#222C67] text-white p-3 rounded shadow hover:bg-blue-700">Save Changes</button>
        </div>
    </div>
</div>

<style>
    .toggle-checkbox:checked {
        right: 0;
        border-color: #222C67;
    }
    .toggle-checkbox:checked + .toggle-label {
        background-color: #222C67;
    }
    .toggle-label {
        transition: background-color 0.3s ease-in-out;
    }
</style>

<script>
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
    }
</script>       

@endsection
