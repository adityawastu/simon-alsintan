<x-layout>

   <!-- Start coding here -->
   <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
         <div class="w-full md:w-1/2">
            <h1 class="text-2xl font-bold mb-2 text-green-700 dark:text-gray-200">Monitoring alat dan mesin pertanian
            </h1>
         </div>

      </div>
      <div class="overflow-x-auto">
         <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
               <tr>
                  <th scope="col" class="px-4 py-2">Unit</th>
                  <th scope="col" class="px-4 py-2">Status</th>
                  <th scope="col" class="px-4 py-2">Details</th>

               </tr>
            </thead>
            <tbody>
               @forelse ($activeAlsintans as $alsintan)
                  i
                  <tr>
                     <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $alsintan->name }}
                     </th>
                     <td class="px-4 py-2">
                        <span
                           class="inline-flex items-center rounded-lg bg-green-100 px-3 py-1.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                           <svg class="me-1 h-3 w-3" fill="none" stroke="currentColor" stroke-width="2"
                              viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                           </svg>
                           Aktif
                        </span>
                     </td>
                     <td class="px-4 py-2">
                        <a href="{{ route('peta.lokasi.alsintan', $alsintan->sensor_id) }}"
                           class="inline-block bg-green-600 hover:bg-green-700 text-white text-xs font-medium px-4 py-2 rounded">
                           Lihat Lokasi
                        </a>
                     </td>
                  </tr>
               @empty
                  <tr>
                     <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                        Tidak ada alsintan yang aktif saat ini.
                     </td>
                  </tr>
               @endforelse
            </tbody>

         </table>
      </div>

   </div>

</x-layout>
