<x-layout>
  <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden p-2">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
      <div class="w-full flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-green-700 dark:text-gray-200">
          Data Alat mesin dan pertanian
        </h1>
        <a href="{{ route('admin.create.alsintan') }}"
          class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
          Tambah Data
        </a>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-4 py-2">Nama</th>
            <th scope="col" class="px-4 py-2">Kategori</th>
            <th scope="col" class="px-4 py-2">Merk</th>
            <th scope="col" class="px-4 py-2">Status</th>
            <th scope="col" class="px-4 py-2">Aksi</th> <!-- Kolom baru untuk tombol -->
          </tr>
        </thead>
        <tbody>
          @foreach ($alsintans as $item)
            <tr>
              <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $item->name }}
              </td>
              <td class="px-4 py-2">
                {{ $item->category->name ?? '-' }}
              </td>
              <td class="px-4 py-2">
                {{ $item->merk->name ?? '-' }}
              </td>

              <td class="px-4 py-2">
                @if ($item->status === 'ON')
                  <div class="text-green-600 font-semibold">Mesin Aktif</div>
                @else
                  <div class="text-red-600 font-semibold">Mesin Tidak Aktif</div>
                @endif

                @if ($item->lastTime)
                  <div class="text-gray-500 text-sm mt-1">
                    Terakhir data diterima:
                    {{ \Carbon\Carbon::parse($item->lastTime)->diffForHumans() }}
                  </div>
                @endif
              </td>
              <td class="px-4 py-2">
                <div class="flex gap-2">
                  <a href="{{ route('admin.alsintan.show', $item->id) }}"
                    class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                    View
                  </a>
                  <form action="{{ route('admin.alsintan.destroy', $item->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-red-600 rounded hover:bg-red-700">
                      Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <nav>
      {{-- Tombol halaman --}}
      <div>
        {{ $alsintans->links() }}
      </div>
    </nav>
  </div>

</x-layout>
