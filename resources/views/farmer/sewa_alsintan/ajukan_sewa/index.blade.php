<x-layout>
  <div class="mt-6">
    <h1 class="text-2xl font-bold text-green-600 mb-6">Sewa Alat Mesin dan Pertanian</h1>
  </div>
  {{-- button cari alat --}}
  <div class="grid grid-cols-4 gap-4">
    {{-- Dropdown Kategori --}}
    <div class="col-span-3">

      <select id="category" name="category"
        class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500">
        <option value="">– Pilih Kategori –</option>
        <option value="1">Traktor</option>
        <option value="2">Pompa Air</option>
        <option value="3">Alat Panen</option>
      </select>
    </div>
    <div class="flex items-end">
      <button type="submit"
        class="w-full px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-400">
        Cari
      </button>
    </div>
  </div>

  <div class="overflow-x-auto mt-6">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-4 py-2">Nama Alat</th>
          <th scope="col" class="px-4 py-2">Kategori</th>
          <th scope="col" class="px-4 py-2">Merk</th>
          <th scope="col" class="px-4 py-2">Status</th>
          <th scope="col" class="px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        {{-- Dummy Data --}}
        <tr>
          <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            Traktor Roda 4
          </td>
          <td class="px-4 py-2">Traktor</td>
          <td class="px-4 py-2">Kubota</td>
          <td class="px-4 py-2">
            <div class="text-green-600 font-semibold">Tersedia</div>
          </td>
          <td class="px-4 py-2">
            <button class="px-3 py-1 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
              Pinjam
            </button>
          </td>
        </tr>

        <tr>
          <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            Pompa Air 5 HP
          </td>
          <td class="px-4 py-2">Pompa Air</td>
          <td class="px-4 py-2">Honda</td>
          <td class="px-4 py-2">
            <div class="text-red-600 font-semibold">Dipinjam</div>
            <div class="text-gray-500 text-xs mt-1">Estimasi kembali: 2 hari</div>
          </td>
          <td class="px-4 py-2">
            <button disabled class="px-3 py-1 text-sm font-semibold text-white bg-gray-400 rounded cursor-not-allowed">
              Tidak Tersedia
            </button>
          </td>
        </tr>

        <tr>
          <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            Mesin Panen Padi
          </td>
          <td class="px-4 py-2">Alat Panen</td>
          <td class="px-4 py-2">Yanmar</td>
          <td class="px-4 py-2">
            <div class="text-green-600 font-semibold">Tersedia</div>
          </td>
          <td class="px-4 py-2">
            <button class="px-3 py-1 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
              Pinjam
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>




</x-layout>
