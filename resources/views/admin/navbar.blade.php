<!--sidenav -->
<div class="fixed left-0 top-0 w-64 h-full bg-[#E3EBF3] p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <img src="{{ asset('assets/img/logo.png') }}" class="w-30 h-24" alt="Logo"></a>
        </a>
        <ul class="mt-4">
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg"   width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                <span class="text-sm">Daftar Tenaga Kesehatan</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="/datapasien" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-user mr-3 text-lg'></i>                 
                <span class="text-sm">Daftar Pasien</span>
            </a>
            
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-bell mr-3 text-lg' ></i>                
                <span class="text-sm">Notifications</span>
                <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <img src="{{ asset('./assets/img/queue.png') }}" alt="Antrian" class="mr-3 w-6">      
                <span class="text-sm">Antrian</span>   
            </a>
        </li>
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<!-- end side nav -->

<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-[#F5f5f5] min-h-screen transition-all main">
    <style>
        @media (min-width: 768px) {
          .main.active {
            margin-left: 0;
            width: 100%;
          }
        }
      </style>
    <!-- navbar -->
    <div class="py-2 px-6 bg-[#f8f4f3] flex items-center shadow-md shadow-black/9 sticky top-0 left-0 z-30">
        <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>

        <ul class="ml-auto flex items-center">
            <li class="mr-1 dropdown">
                    <form action="" class="p-4 border-b border-b-gray-100">
                        <div class="relative w-full">
                            <input type="text" class="py-2 pr-4 pl-10 bg-gray-50 w-full outline-none border border-gray-100 rounded-md text-sm focus:border-blue-500" placeholder="Cari...">
                            <i class="ri-search-line absolute top-1/2 left-4 -translate-y-1/2 text-gray-900"></i>
                        </div>
                    </form>
            </li>
            <li class="dropdown">
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
                        <ul class="max-h-64 overflow-y-auto hidden" data-tab-for="notification" data-page="messages">
                        </ul>
                    </div>
                </div>
            </li>
            

            <li class="dropdown ml-3">
                <button type="button" class="dropdown-toggle flex items-center">
                    <div class="flex-shrink-0 w-10 h-10 relative">
                        <div class="p-1 bg-white rounded-full focus:outline-none focus:ring">
                            <img class="w-8 h-8 rounded-full" src="https://laravelui.spruko.com/tailwind/ynex/build/assets/images/faces/9.jpg" alt=""/>
                            <div class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping"></div>
                            <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full"></div>
                        </div>
                    </div>
                    <div class="p-2 md:block text-left">
                        <h2 class="text-sm font-semibold text-gray-800">John Doe</h2>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>                
                </button>
                <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                    <li>
                        <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Profile</a>
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
                                Log Out
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- end navbar -->