<!-- sidenav -->
<div class="fixed left-0 top-0 w-64 h-full bg-[#E3EBF3] p-4 z-50 sidebar-menu transition-transform -translate-x-full md:translate-x-0">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <img src="{{ asset('assets/img/logo.png') }}" class="w-30 h-24" alt="Logo"></a>
    </a>
    <ul class="mt-4">
        <li class="mb-1 group">
            <a href="{{ route('admin.dashboard') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('admin/dashboard') ? 'bg-[#222C67] text-white' : '' }}">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-md">Dashboard</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.index.antrian') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('admin/antrian*') ? 'bg-[#222C67] text-white fill-white' : 'text-gray-900 hover:bg-[#222C67] hover:text-gray-100 hover:fill-white' }}">
                <svg class="mr-1 w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                    <circle cx="22" cy="20" r="10"/>
                    <path d="M22,34c-9.39,0-16,4.5-16,9v5h32v-5C38,38.5,31.39,34,22,34z"/>
                    <circle cx="36" cy="14" r="8" opacity="0.7"/>
                    <path d="M36,24c-7.18,0-12,3.5-12,7v4h24v-4C48,27.5,43.18,24,36,24z" opacity="0.7"/>
                    <circle cx="48" cy="10" r="6" opacity="0.5"/>
                    <path d="M48,18c-5.39,0-8,2.7-8,5v3h16v-3C56,20.7,53.39,18,48,18z" opacity="0.5"/>
                </svg>
                <span class="text-sm">Antrian</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.data.pasien') }}" class="flex font-semibold items-center py-2 px-4 rounded-md text-gray-900 hover:bg-[#222C67] hover:text-gray-100 {{ request()->is('admin/data-pasien*') ? 'bg-[#222C67] text-white' : '' }}">
                <i class='bx bx-user mr-3 text-lg'></i>
                <span class="text-sm">Kelola Pasien</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.index.dokter') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('admin/dokter*') ? 'bg-[#222C67] text-white fill-white' : 'text-gray-900 hover:bg-[#222C67] hover:text-gray-100 hover:fill-white' }}">
                <svg class="mr-3 w-[16px] h-[16px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                <span class="text-sm">Kelola Dokter</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.jadwal.dokter.index') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('admin/jadwal-dokter*') ? 'bg-[#222C67] text-white fill-white' : 'text-gray-900 hover:bg-[#222C67] hover:text-gray-100 hover:fill-white' }}">
                <svg class="mr-3 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/></svg>
                <span class="text-sm">Kelola Jadwal Dokter</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.perawat.index') }}" class="flex font-semibold items-center py-2 px-4 rounded-md text-gray-900 hover:bg-[#222C67] hover:text-gray-100 {{ request()->is('admin/perawat*') ? 'bg-[#222C67] text-white' : '' }}">
                <i class='bx bx-user mr-3 text-lg'></i>
                <span class="text-sm">Kelola Perawat</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-bell mr-3 text-lg'></i>
                <span class="text-sm">Notifications</span>
                <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
            </a>
        </li>
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay hidden"></div>
<!-- end sidenav -->

<main id="main" class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-[#F5f5f5] min-h-screen transition-all main">
    <!-- navbar -->
    <div class="py-2 px-6 bg-[#f8f4f3] flex items-center shadow-md shadow-black/9 sticky top-0 left-0 z-30">
        <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="ml-auto flex items-center">
            <li class="dropdown
                @switch(request()->path())
                    @case('admin/perawat')
                        {{ '' }}
                        @break
                    @case('admin/dokter')
                        {{ '' }}
                        @break
                    @default
                        {{ 'hidden' }}
                @endswitch
            ">
                <button type="button" class="dropdown-toggle text-gray-400 mr-4 w-8 h-8 rounded flex items-center justify-center  hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-100 rounded-full mt-[3px]" viewBox="0 0 24 24" style="fill: gray;transform: ;msFilter:;"><path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path></svg>
                </button>
                <div class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                    <form onsubmit="return false" class="p-4 border-b border-b-gray-100">
                        <div class="relative w-full">
                            <input id="cari" type="text" class="py-2 pr-4 pl-10 bg-gray-50 w-full outline-none border border-gray-100 rounded-md text-sm focus:border-blue-500" placeholder="Cari...">
                            <i class="ri-search-line absolute top-1/2 left-4 -translate-y-1/2 text-gray-900"></i>
                        </div>
                    </form>
                </div>
            </li>
            <li class="dropdown">
                <button type="button" class="dropdown-toggle text-gray-400 mr-4 w-8 h-8 rounded flex items-center justify-center  hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24" style="fill: gray;transform: ;msFilter:;"><path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"></path></svg>
                </button>
                <div class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                    <div class="flex items-center px-4 pt-4 border-b border-b-gray-100 notification-tab">
                        <button type="button" data-tab="notification" data-tab-page="notifications" class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1 active">Notifications</button>
                        <button type="button" data-tab="notification" data-tab-page="messages" class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1">Messages</button>
                    </div>
                    <div class="my-2">
                        <ul class="max-h-64 overflow-y-auto" data-tab-for="notification" data-page="notifications">
                            <li>
                                <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                    <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                    <div class="ml-2">
                                        <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                        <div class="text-[11px] text-gray-400">from a user</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                    <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                    <div class="ml-2">
                                        <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                        <div class="text-[11px] text-gray-400">from a user</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                    <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                    <div class="ml-2">
                                        <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                        <div class="text-[11px] text-gray-400">from a user</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                    <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                    <div class="ml-2">
                                        <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                        <div class="text-[11px] text-gray-400">from a user</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                    <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                    <div class="ml-2">
                                        <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                        <div class="text-[11px] text-gray-400">from a user</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <ul class="max-h-64 overflow-y-auto hidden" data-tab-for="notification" data-page="messages"></ul>
                    </div>
                </div>
            </li>
            <button id="fullscreen-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24" style="fill: gray;transform: ;msFilter:;"><path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"></path></svg>
            </button>
            <li class="dropdown ml-3">
                <button type="button" class="dropdown-toggle flex items-center">
                    <div class="flex-shrink-0 w-10 h-10 relative">
                        <div class="p-1 bg-white rounded-full focus:outline-none focus:ring">
                            @if(auth()->user()->foto == null)
                                <svg id="default" class="w-8 h-8" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                            @else
                                <div class="w-8 h-8 aspect-square overflow-hidden rounded-full">
                                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="object-cover object-top w-full h-full">
                                </div>
                            @endif
                            <div class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping"></div>
                            <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full"></div>
                        </div>
                    </div>
                    <div class="p-2 md:block text-left">
                        <h2 class="text-sm font-semibold text-gray-800">{{ auth()->user()->admin->nama }}</h2>
                        <p class="text-xs text-gray-500">{{ auth()->user()->status }}</p>
                    </div>
                </button>
                <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                    <li>
                        <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Profil</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Settings</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a role="menuitem" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50 cursor-pointer"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                Keluar
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- end navbar -->