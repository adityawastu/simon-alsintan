@props(['user'])

<ul class="space-y-2">

  {{-- Profile --}}
  <li>
    <div class="flex items-center justify-center">
      <button type="button"
        class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
        <span class="sr-only">Open user menu</span>
        <img class="w-12 h-12 rounded-full" src="{{ asset($user->image ? 'storage/' . $user->image : 'images/default-user.png') }}"
          alt="user photo">
      </button>
      <div class="py-3 px-4">
        <span class="block text-sm font-semibold text-gray-900 dark:text-white">
          {{ $user->name }}
        </span>
        <span class="inline-block px-1 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">
          Role {{ ucfirst($user->role) }}
        </span>
      </div>

      <!-- Dropdown menu -->
      <div
        class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown">
        <ul class="py-1 text-gray-700 dark:text-gray-300">
          {{-- menu profile user --}}
          <li class="p-2">
            <a href="{{ route('farmer.profile.show') }}"
              class="block w-full text-left py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
              Profile
            </a>
          </li>
          {{-- log out user farmer --}}
          <li class="p-2">
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

  {{-- Beranda --}}
  <li class="mt-5">
    <a href="{{ route('farmer.beranda') }}"
      class="flex items-center p-2 text-base font-normal rounded-lg transition duration-150 ease-in-out
        {{ Route::is('farmer.beranda')
            ? 'bg-green-500 text-white'
            : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
      <svg aria-hidden="true"
        class="w-6 h-6 transition duration-75
              {{ Route::is('farmer.beranda')
                  ? 'text-white'
                  : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
        fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10.707 1.707a1 1 0 00-1.414 0L2 9h2v7a1 1 0 001 1h3a1
               1 0 001-1v-4h2v4a1 1 0 001 1h3a1
               1 0 001-1V9h2L10.707 1.707z" clip-rule="evenodd" />
      </svg>
      <span class="ml-2">Beranda</span>
    </a>
  </li>
  {{-- data alsintan --}}
  {{-- <li class="">
    <a href="{{ route('farmer.dataalsintan.index') }}"
      class="flex items-center p-2 text-base font-normal rounded-lg transition duration-150 ease-in-out
        {{ Route::is('farmer.dataalsintan.index')
            ? 'bg-green-500 text-white'
            : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
      <svg aria-hidden="true"
        class="w-6 h-6 transition duration-75
              {{ Route::is('farmer.dataalsintan.index')
                  ? 'text-white'
                  : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
        xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24" height="24" viewBox="0 0 24 24">
        <path fill-rule="evenodd"
          d="M4 4a2 2 0 0 0-2 2v9a1 1 0 0 0 1 1h.535a3.5 3.5 0 1 0 6.93 0h3.07a3.5 3.5 0 1 0 6.93 0H21a1 1 0 0 0 1-1v-4a.999.999 0 0 0-.106-.447l-2-4A1 1 0 0 0 19 6h-5a2 2 0 0 0-2-2H4Zm14.192 11.59.016.02a1.5 1.5 0 1 1-.016-.021Zm-10 0 .016.02a1.5 1.5 0 1 1-.016-.021Zm5.806-5.572v-2.02h4.396l1 2.02h-5.396Z"
          clip-rule="evenodd" />
      </svg>
      <span class="ml-2">Data Alsintan</span>
    </a>
  </li> --}}

  {{-- Sewa Alsintan (collapse) --}}
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
      <span class="flex-1 ml-2 text-left whitespace-nowrap text-base font-normal">Sewa Alsintan</span>
      <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
          clip-rule="evenodd"></path>
      </svg>
    </button>
    <ul id="dropdown-pages"
      class="{{ request()->routeIs('farmer.ajukansewa.index') || request()->routeIs('farmer.statuspengajuan.index') || request()->routeIs('farmer.riwayatpenyewaan.index') ? 'py-2 space-y-2' : 'hidden py-2 space-y-2' }}">

      {{-- ajukan sewa --}}
      <li>
        <a href="{{ route('farmer.ajukansewa.index') }}"
          class="flex items-center p-2 pl-11 w-full text-base rounded-lg transition duration-75 group
            {{ request()->routeIs('farmer.ajukansewa.index')
                ? 'bg-green-500 text-white'
                : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
          Ajukan Sewa
        </a>
      </li>

      {{-- status penyewaan --}}
      <li>
        <a href="{{ route('farmer.statuspengajuan.index') }}"
          class="flex items-center p-2 pl-11 w-full text-base rounded-lg transition duration-75 group
            {{ request()->routeIs('farmer.statuspengajuan.index')
                ? 'bg-green-500 text-white'
                : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
          Status pengajuan
        </a>
      </li>
      {{-- Riwayat Penyewaan --}}
      <li>
        <a href="{{ route('farmer.riwayatpenyewaan.index') }}"
          class="flex items-center p-2 pl-11 w-full text-base rounded-lg transition duration-75 group
            {{ request()->routeIs('farmer.riwayatpenyewaan.index')
                ? 'bg-green-500 text-white'
                : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
          Riwayat Penyewaan
        </a>
      </li>
    </ul>
  </li>
</ul>
