<li class="mb-1 group">
    <a href="{{ route('admin.dashboard') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('admin/dashboard') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-house mr-3 text-lg"></i>
        <span class="text-md">Dashboard</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('index.antrian') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('antrian*') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-users-line mr-3 text-lg"></i>
        <span class="text-md">Antrian</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('admin.data.pasien') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('admin/pasien*') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-hospital-user mr-3 text-lg"></i>
        <span class="text-md">Kelola Pasien</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('admin.index.dokter') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('admin/dokter*') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-user-doctor mr-3 text-lg"></i>        
        <span class="text-md">Kelola Dokter</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('admin.jadwal.dokter.index') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('admin/jadwal-dokter*') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-regular fa-calendar-check mr-3 text-lg"></i>
        <span class="text-md">Kelola Jadwal Dokter</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('admin.perawat.index') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('admin/perawat*') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-user-nurse mr-3 text-lg"></i>
        <span class="text-md">Kelola Perawat</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
        <i class='bx bx-bell mr-3 text-lg'></i>
        <span class="text-md">Notifications</span>
        <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
    </a>
</li>