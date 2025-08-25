@php
   /** @var \App\Models\User|null $user */
   $user = Auth::user();
@endphp

<aside
   class="fixed top-0 left-0 z-40 w-64 h-[94vh] mt-15 pt-0 transition-transform -translate-x-full md:translate-x-0 shadow-lg rounded-xl"
   aria-label="Sidenav" id="drawer-navigation">
   <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800 rounded-2xl">
      @if ($user && $user->role === 'admin')
         <x-sidebar.admin :user="$user" />
      @elseif ($user && $user->role === 'upja')
         <x-sidebar.upja :user="$user" />
      @elseif ($user && $user->role === 'farmer')
         <x-sidebar.farmer :user="$user" />
      @else
         <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a>
      @endif
   </div>
</aside>
