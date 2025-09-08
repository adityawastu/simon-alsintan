<!-- resources/views/admin/alsintan/index.blade.php -->
<x-layout>
  <div class="bg-white dark:bg-gray-800 relative overflow-hidden p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between">
      <h1 class="text-2xl font-bold text-green-700 dark:text-gray-200 mb-4 md:mb-0">
        Data Alat Mesin dan Pertanian
      </h1>
      <a href="{{ route('admin.create.alsintan') }}"
        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-300">
        + Tambah Alsintan
      </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg ">
      <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
        <thead class="text-xs text-gray-700 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th class="px-5 py-3">Nama</th>
            <th class="px-5 py-3">Kategori</th>
            <th class="px-5 py-3">Merk</th>
            <th class="px-5 py-3 text-center">Status Sensor</th>
            <th class="px-5 py-3 text-center">Status Alat</th>
            <th class="px-5 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($alsintans as $item)
            <tr class=" hover:bg-gray-50 dark:hover:bg-gray-700 transition">
              <!-- Nama -->
              <td class="px-5 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $item->name }}
              </td>

              <!-- Kategori -->
              <td class="px-5 py-3">
                {{ $item->category->name ?? '-' }}
              </td>

              <!-- Merk -->
              <td class="px-5 py-3">
                {{ $item->merk->name ?? '-' }}
              </td>

              <!-- Status Sensor -->
              <td class="px-5 py-3 text-center">
                @if (empty($item->sensor_id))
                  <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Sensor Tidak Terpasang
                  </span>
                @else
                  <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Sensor Terpasang
                  </span>
                @endif
              </td>

              <!-- Status Alat -->
              <td class="px-5 py-3 text-center">
                @if (empty($item->sensor_id))
                  <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Tidak Tersedia
                  </span>
                @else
                  @if ($item->status === 'ON')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                      Mesin Aktif
                    </span>
                  @else
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                      Mesin Tidak Aktif
                    </span>
                  @endif

                  @if ($item->lastTime)
                    <div class="text-gray-400 text-xs mt-1 italic">
                      Terakhir update: {{ \Carbon\Carbon::parse($item->lastTime)->diffForHumans() }}
                    </div>
                  @endif
                @endif
              </td>

              <!-- Tombol Aksi -->
              <td class="px-5 py-3 text-center">
                <div class="flex justify-center gap-3">
                  <a href="{{ route('admin.alsintan.show', $item->id) }}"
                    class="px-4 py-1 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                    Lihat
                  </a>
                  <form action="{{ route('admin.alsintan.destroy', $item->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="px-4 py-1 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-5 py-5 text-center text-gray-500">
                Tidak ada data alat dan mesin pertanian.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
      {{ $alsintans->links() }}
    </div>
  </div>
</x-layout>
