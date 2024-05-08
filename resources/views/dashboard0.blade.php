<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session()->has('notif'))
        <div id="notif-login" class="absolute top-4 left-0 right-0 mx-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-60">
                <div class="bg-white dark:bg-[#111826] overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        Selamat datang {{ auth()->user()->name }}!
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="flex">
        <div id="div-tombol" class="py-12 mx-auto">
            <button onclick="ambilData('{{ route('tugas.pimk') }}')" class="text-gray-900 dark:text-gray-100 max-w-7xl bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-10 w-44">
                Tugas PIMK
            </button>
        </div>
        <table id="table" class="dark:text-gray-100 mx-auto w-9/12 hidden mt-12">
            <tr>
                <th class="text-start">Name</th>
                <th class="text-start">Email</th>
                <th class="text-start">Verified</th>
            </tr>
            <tbody id="table-content"></tbody>
        </table>
    </div>
    @push('scripts')
        <script src="{{ asset('./assets/js/async-pimk.js') }}"></script>
    @endpush
</x-app-layout>