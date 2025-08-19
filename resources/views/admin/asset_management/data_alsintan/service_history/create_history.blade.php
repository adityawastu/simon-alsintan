<x-layout>
   <a href="{{ url()->previous() }}"
      class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-700 rounded hover:bg-green-800">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
         <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
      </svg>
      Kembali
   </a>
   <form action="{{ route('admin.service.store') }}" method="POST">
      @csrf
      <input type="hidden" name="data_alsintan_id" value="{{ $alsintan->id }}">

      <div class="mb-4">
         <label for="service_datetime" class="block text-sm font-medium">Tanggal & Jam Servis</label>
         <input type="datetime-local" name="service_datetime" id="service_datetime"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
      </div>

      <div class="mb-4">
         <label for="pic" class="block text-sm font-medium">Penanggung Jawab</label>
         <input type="text" name="pic" id="pic"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
      </div>

      <div class="mb-4">
         <label for="mechanic" class="block text-sm font-medium">Mekanik</label>
         <input type="text" name="mechanic" id="mechanic"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
      </div>

      <div class="mb-4">
         <label for="notes" class="block text-sm font-medium">Catatan Servis</label>
         <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
      </div>

      <div>
         <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md ">
            Simpan Riwayat Servis
         </button>
      </div>
   </form>
</x-layout>
