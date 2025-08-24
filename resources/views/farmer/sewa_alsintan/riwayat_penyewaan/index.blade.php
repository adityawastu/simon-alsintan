<x-layout>
  {{-- resources/views/peminjaman/riwayat.blade.php --}}
  {{-- Tampilan Riwayat Peminjaman --}}

  <div class="mt-6">
    <h2 class="text-2xl font-bold text-green-600 mb-6"> Riwayat Peminjaman </h2>
    </h2>

    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
        <thead class="text-xs uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th class="px-4 py-2">Nama Alat</th>
            <th class="px-4 py-2">Kategori</th>
            <th class="px-4 py-2">Tanggal Pinjam</th>
            <th class="px-4 py-2">Tanggal Kembali</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          {{-- Dummy data --}}
          <tr>
            <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">Traktor Roda 4</td>
            <td class="px-4 py-2">Traktor</td>
            <td class="px-4 py-2">1 Agustus 2025</td>
            <td class="px-4 py-2">5 Agustus 2025</td>
            <td class="px-4 py-2">
              <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded">
                Selesai
              </span>
            </td>
            <td class="px-4 py-2">
              <button class="px-3 py-1 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                Detail
              </button>
            </td>
          </tr>

          <tr>
            <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">Pompa Air 5 HP</td>
            <td class="px-4 py-2">Pompa Air</td>
            <td class="px-4 py-2">10 Agustus 2025</td>
            <td class="px-4 py-2">-</td>
            <td class="px-4 py-2">
              <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded">
                Sedang Dipinjam
              </span>
            </td>
            <td class="px-4 py-2">
              <button class="px-3 py-1 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                Detail
              </button>
            </td>
          </tr>

          <tr>
            <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">Mesin Panen Padi</td>
            <td class="px-4 py-2">Alat Panen</td>
            <td class="px-4 py-2">15 Juli 2025</td>
            <td class="px-4 py-2">20 Juli 2025</td>
            <td class="px-4 py-2">
              <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded">
                Terlambat
              </span>
            </td>
            <td class="px-4 py-2">
              <button class="px-3 py-1 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                Detail
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</x-layout>
