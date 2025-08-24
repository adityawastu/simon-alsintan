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
        <span class="block text-sm text-gray-900 truncate dark:text-white">
          Role {{ $user->role }}
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

  {{-- Beranda --}}
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

  {{-- Dashboard --}}
  <li>
    <a href="{{ route('admin.dashboard') }}"
      class="flex items-center p-2 text-base font-normal rounded-lg transition duration-150 ease-in-out
        {{ Route::is('admin.dashboard')
            ? 'bg-green-500 text-white'
            : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
      <svg aria-hidden="true"
        class="w-6 h-6 transition duration-75
              {{ Route::is('admin.dashboard')
                  ? 'text-white'
                  : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
        fill="currentColor" viewBox="0 0 20 20">
        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
      </svg>
      <span class="ml-2">Dashboard</span>
    </a>
  </li>

  {{-- Asset Management --}}
  <li>
    <button type="button"
      class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
      aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
      <svg aria-hidden="true"
        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
        fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
          d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1
