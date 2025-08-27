<x-layout>
  <div class="bg-white dark:bg-gray-800 relative overflow-hidden p-4">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-green-700 dark:text-gray-200">
        Riwayat Peminjaman Alsintan
      </h1>
      <a href="{{ route('admin.peminjaman.index') }}"
        class="inline-flex items-center px-4 py-2 mt-3 sm:mt-0 text-sm font-medium text-white bg-green-600 rounded-lg shadow hover:bg-green-700 transition-all">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali
      </a>
    </div>

    <!-- Alert -->
    @if (session('success'))
      <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100 border border-green-300" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-9-4a1 1 0 112 0v4a1 1 0 01-2 0V6zm2 6a1 1 0 11-2 0 1 1 0 012 0z"
            clip-rule="evenodd"></path>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
      </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
      <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
        <thead class="text-xs text-gray-700 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-300">
          <tr>
            <th class="px-5 py-3">#</th>
            <th class="px-5 py-3">Nama Peminjam</th>
            <th class="px-5 py-3">Alsintan</th>
            <th class="px-5 py-3">Tanggal Pinjam</th>
            <th class="px-5 py-3">Tanggal Kembali</th>
            <th class="px-5 py-3">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($riwayat as $item)
            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
              <!-- No -->
              <td class="px-5 py-3 font-medium text-gray-900 dark:text-gray-100">
                {{ $loop->iteration }}
              </td>

              <!-- Nama Peminjam -->
              <td class="px-5 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $item->user->name }}
              </td>

              <!-- Nama Alsintan -->
              <td class="px-5 py-3">{{ $item->alsintan->name }}</td>

              <!-- Tanggal Pinjam -->
              <td class="px-5 py-3">
                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
              </td>

              <!-- Tanggal Kembali -->
              <td class="px-5 py-3">
                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
              </td>

              <!-- Status -->
              <td class="px-5 py-3">
                @php
                  $statusClasses = [
                      'returned' => 'bg-green-100 text-green-800 border border-green-300',
                      'rejected' => 'bg-red-100 text-red-800 border border-red-300',
                      'overdue' => 'bg-orange-100 text-orange-800 border border-orange-300',
                      'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                  ];
                @endphp
                <span
                  class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$item->status] ?? 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                  {{ ucfirst($item->status) }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400 text-sm italic">
                Tidak ada riwayat peminjaman.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-5">
      <p class="text-sm text-gray-500 dark:text-gray-400">
        Menampilkan {{ $riwayat->firstItem() ?? 0 }} - {{ $riwayat->lastItem() ?? 0 }} dari {{ $riwayat->total() }} data
      </p>
      <div>
        {{ $riwayat->links() }}
      </div>
    </div>
  </div>
</x-layout>
