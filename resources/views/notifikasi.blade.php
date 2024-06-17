@extends('layouts.main')

@section('container')

<div class="container mx-auto p-4 mb-44">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white text-[#222C67] dark:text-white">Notifikasi Pasien</h1>
    </div>

    <hr class="border-1 border-[#B1B0AF] dark:border-gray-600 mb-8">
    <div class="space-y-4">
        <!-- Notification 1 -->
        <div class="bg-white dark:bg-gray-900 border-l-4 border-yellow-600 rounded-lg shadow-md p-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="text-yellow-600 text-2xl">•</span>
                <div>
                    <p class="text-lg text-gray-700 dark:text-gray-300">
                        Your appointment with <span class="font-bold text-[#222C67] dark:text-white">dr. blabla</span> on 
                        <span class="font-bold text-[#222C67] dark:text-white">Monday 1 January at 09:00 AM</span> has been 
                        <span class="font-semibold text-yellow-600">reserved successfully</span>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Notification 2 -->
        <div class="bg-white dark:bg-gray-900 border-l-4 border-red-600 rounded-lg shadow-md p-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="text-red-600 text-2xl">•</span>
                <div>
                    <p class="text-lg text-gray-700 dark:text-gray-300">
                        You <span class="font-semibold text-red-600">successfully canceled </span> your appointment with <span class="font-bold text-[#222C67] dark:text-white">dr. blabla</span> on 
                        <span class="font-bold text-[#222C67] dark:text-white">Monday 1 January at 09:00 AM</span>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Notification 3 -->
        <div class="bg-white dark:bg-gray-900 border-l-4 border-green-600 rounded-lg shadow-md p-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="text-green-600 text-2xl">•</span>
                <div>
                    <p class="text-lg text-gray-700 dark:text-gray-300">
                        Your appointment with <span class="font-bold text-[#222C67] dark:text-white">dr. blabla</span> on 
                        <span class="font-bold text-[#222C67] dark:text-white">Monday 1 January at 09:00 AM </span>
                            has been <span class="font-semibold text-green-600">done successfully</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
