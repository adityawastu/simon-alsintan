<x-layout>
  <div class="w-full px-6 lg:px-8 py-8">
    {{-- Breadcrumb + Title --}}
    <div class="flex items-center justify-between gap-4 mb-6">
      <div class="flex items-center gap-3">
        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M4 7a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V7z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 11h8M8 15h5M8 7h8" />
        </svg>
        <div>
          <nav class="text-sm text-gray-500 dark:text-gray-400">
            <ol class="flex items-center gap-1">
              <li><a href="/" class="hover:text-gray-700 dark:hover:text-gray-200">Dashboard</a></li>
              <li class="px-1">/</li>
              <li class="text-gray-700 dark:text-gray-200 font-medium">Profil Petani</li>
            </ol>
          </nav>
          <h1 class="text-2xl font-semibold text-gray-900 dark:text-white leading-tight">Profil Petani</h1>
        </div>
      </div>

      {{-- <div class="flex items-center gap-3">
        @if ($profile)
          <a href="{{ route('farmer.profile.edit') }}"
            class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/60 transition">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M16.862 3.487a2.1 2.1 0 1 1 2.971 2.971L8.41 17.88l-3.79.819.819-3.79L16.862 3.487z" />
            </svg>
            Edit
          </a>
        @else
          <a href="{{ route('farmer.profile.create') }}"
            class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/60 transition">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16M4 12h16" />
            </svg>
            Buat Profil
          </a>
        @endif
      </div> --}}
    </div>

    {{-- Status alert --}}
    @if (session('status'))
      <div
        class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 dark:bg-emerald-950/50 dark:text-emerald-200 dark:border-emerald-900/50">
        {{ session('status') }}
      </div>
    @endif

    @if (!$profile)
      {{-- Empty state --}}
      <div
        class="rounded-2xl border border-dashed border-gray-300 bg-white p-10 text-center shadow-sm dark:bg-gray-900/40 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Belum ada profil</h2>
        <p class="mt-1 text-gray-600 dark:text-gray-300">Lengkapi data Anda untuk mempermudah layanan Alsintan & verifikasi akun.</p>
        <div class="mt-6">
          <a href="{{ route('farmer.profile.create') }}"
            class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/60 transition">
            Lengkapin Profile
          </a>
        </div>
      </div>
    @else
      {{-- Content --}}
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Card: Data Akun --}}
        <div class="lg:col-span-1 rounded-2xl bg-white shadow-sm border border-gray-200 p-6 dark:bg-gray-900/40 dark:border-gray-800">
          <div class="flex items-start justify-between">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Data Akun</h2>
            <span
              class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">
              {{ ucfirst($user->role) }}
            </span>
          </div>
          <dl class="mt-4 space-y-3">
            <div class="flex items-start justify-between gap-4">
              <dt class="text-sm text-gray-500 dark:text-gray-400">Nama</dt>
              <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</dd>
            </div>
            <div class="flex items-start justify-between gap-4">
              <dt class="text-sm text-gray-500 dark:text-gray-400">Email</dt>
              <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->email }}</dd>
            </div>
            <div class="flex items-start justify-between gap-4">
              <dt class="text-sm text-gray-500 dark:text-gray-400">Status Profil</dt>
              <dd class="text-sm">
                <span
                  class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">
                  Lengkap
                </span>
              </dd>
            </div>
          </dl>
          <div class="mt-6">
            <a href="{{ route('farmer.profile.edit') }}"
              class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800/60 transition">
              Ubah Data
            </a>
          </div>
        </div>

        {{-- Card: Data Profil --}}
        <div class="lg:col-span-2 rounded-2xl bg-white shadow-sm border border-gray-200 p-6 dark:bg-gray-900/40 dark:border-gray-800">
          <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Data Profil</h2>
            @if ($profile->luas_lahan)
              <div class="text-sm text-gray-500 dark:text-gray-400">
                Est. Luas Lahan: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ number_format($profile->luas_lahan, 2) }}
                  ha</span>
              </div>
            @endif
          </div>

          <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="rounded-xl ring-1 ring-gray-200 p-4 dark:ring-gray-800">
              <dt class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">No. KTP</dt>
              <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $profile->no_ktp }}</dd>
            </div>

            <div class="rounded-xl ring-1 ring-gray-200 p-4 dark:ring-gray-800">
              <dt class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Kontak</dt>
              <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $profile->kontak }}</dd>
            </div>

            <div class="rounded-xl ring-1 ring-gray-200 p-4 dark:ring-gray-800">
              <dt class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Luas Lahan</dt>
              <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $profile->luas_lahan ?? '-' }} ha</dd>
            </div>
          </div>

          <div class="mt-4 rounded-xl ring-1 ring-gray-200 p-4 dark:ring-gray-800">
            <dt class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Alamat Lengkap</dt>
            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 leading-relaxed">
              {{ $profile->alamat }},
              Desa {{ $profile->desa }},
              Kec. {{ $profile->kecamatan }},
              Kab. {{ $profile->kabupaten }},
              Prov. {{ $profile->provinsi }}
            </dd>
          </div>

          <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ route('farmer.profile.edit') }}"
              class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/60 transition">
              Edit Profil
            </a>
          </div>
        </div>
      </div>
    @endif
  </div>
</x-layout>
