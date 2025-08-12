@php
   /** @var \App\Models\User|null $user */
   $user = Auth::user();
@endphp

<aside
   class="fixed top-0 left-0 z-40 w-64 h-[94vh] mt-15 pt-0 transition-transform -translate-x-full md:translate-x-0 shadow-lg rounded-xl"
   aria-label="Sidenav" id="drawer-navigation">
   <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800 rounded-2xl">

      @if ($user && $user->role === 'admin')
         <ul class="space-y-2">
            <li>
               <div class="flex items-center justify-center">
                  <button type="button"
                     class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                     id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                     <span class="sr-only">Open user menu</span>
                     <img class="w-12 h-12 rounded-full"
                        src="{{ asset($user->image ? 'storage/' . $user->image : 'images/default-user.png') }}"
                        alt="user photo">
                  </button>
                  <div class="py-3 px-4">
                     <span class="block text-sm font-semibold text-gray-900 dark:text-white">
                        {{ $user->name }}
                     </span>
                     <span class="block text-sm text-gray-900 truncate dark:text-white">
                        {{ $user->email }}
                     </span>
                  </div>

                  <!-- Dropdown menu -->
                  <div
                     class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                     id="dropdown">
                     <ul class="py-1 text-gray-700 dark:text-gray-300"></ul>
                     <ul class="py-1 text-gray-700 dark:text-gray-300">
                        <li>
                           <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button type="submit"
                                 class="block w-full text-left py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                 Sign out
                              </button>
                           </form>
                        </li>
                     </ul>
                  </div>
               </div>
            </li>

            <li class="mt-5">
               <a href="{{ route('admin.beranda') }}"
                  class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true"
                     class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     fill="currentColor" viewBox="0 0 20 20">
                     <path fill-rule="evenodd"
                        d="M10.707 1.707a1 1 0 00-1.414 0L2 9h2v7a1 1 0 001 1h3a1 1 0 001-1v-4h2v4a1 1 0 001 1h3a1 1 0 001-1V9h2L10.707 1.707z"
                        clip-rule="evenodd" />
                  </svg>
                  <span class="ml-2">Beranda</span>
               </a>
            </li>

            <li>
               <a href="{{ route('admin.dashboard') }}"
                  class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true"
                     class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     fill="currentColor" viewBox="0 0 20 20">
                     <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                     <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                  </svg>
                  <span class="ml-2">Dashboard</span>
               </a>
            </li>

            <li>
               <button type="button"
                  class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                  <svg aria-hidden="true"
                     class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                     fill="currentColor" viewBox="0 0 20 20">
                     <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                        clip-rule="evenodd"></path>
                  </svg>
                  <span class="flex-1 ml-2 text-left whitespace-nowrap text-base font-normal">Asset Management</span>
                  <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                     <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                  </svg>
               </button>
               <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                  <li>
                     <a href="{{ route('admin.index_alsintan') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-sm text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        Data Alsintan
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('admin.index.peta.lokasi') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-sm text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        Peta & Lokasi
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('admin.monitoring.aktivitas') }}"
                        class="flex items-center p-2 pl-11 w-full text-base font-sm text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        Monitoring Aktivitas
                     </a>
                  </li>
               </ul>
            </li>

            <li>
               <a href=""
                  class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg class="w-6 h-6 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                     <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                  </svg>
                  <span class="ml-2">User Management</span>
               </a>
            </li>
         </ul>
      @elseif ($user && $user->role === 'upja')
         <a href="{{ route('upja.dashboard') }}">Dashboard UPJA</a>
      @elseif ($user && $user->role === 'farmer')
         <a href="{{ route('farmer.dashboard') }}">Dashboard Farmer</a>
      @else
         <a href="{{ route('login') }}">Login</a>
      @endif

   </div>
</aside>
