<x-layout>
  <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden p-2">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
      <div class="w-full flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-green-700 dark:text-gray-200">
          Riwayat Peminjaman Alsintan
        </h1>
        <a href="{{ route('admin.peminjaman.index') }}"
          class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
          ← Kembali ke Peminjaman
        </a>
      </div>
    </div>

    <!-- Alert -->
    @if (session('success'))
      <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-4 py-2">#</th>
            <th scope="col" class="px-4 py-2">Nama Peminjam</th>
            <th scope="col" class="px-4 py-2">Alsintan</th>
            <th scope="col" class="px-4 py-2">Tanggal Pinjam</th>
            <th scope="col" class="px-4 py-2">Tanggal Kembali</th>
            <th scope="col" class="px-4 py-2">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($riwayat as $item)
            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
              <!-- No -->
              <td class="px-4 py-2">{{ $loop->iteration }}</td>

              <!-- Nama Peminjam -->
              <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $item->user->name }}
              </td>

              <!-- Nama Alsintan -->
              <td class="px-4 py-2">{{ $item->alsintan->name }}</td>

              <!-- Tanggal Pinjam -->
              <td class="px-4 py-2">
                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
              </td>

              <!-- Tanggal Kembali -->
              <td class="px-4 py-2">
                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
              </td>

              <!-- Status -->
              <td class="px-4 py-2">
                @php
                  $statusColors = [
                      'returned' => 'bg-gray-100 text-gray-700',
                      'rejected' => 'bg-red-100 text-red-700',
                      'overdue' => 'bg-orange-100 text-orange-700',
                  ];
                @endphp
                <span
                  class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-700' }}">
                  {{ ucfirst($item->status) }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-gray-500">
                Tidak ada riwayat peminjaman
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <nav>
      <div class="p-4">
        {{ $riwayat->links() }}
      </div>
    </nav>
  </div>
</x-layout>
