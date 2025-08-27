<x-layout>
  {{-- Tombol Kembali --}}
  <a href="{{ url()->previous() }}"
    class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 transition">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>

  {{-- Judul Halaman --}}
  <div class="mb-5 border-b border-gray-200 pb-3">
    <h1 class="text-2xl font-semibold text-gray-900">Tambah Riwayat Servis</h1>
    <p class="text-sm text-gray-500">Isi formulir di bawah untuk menambahkan data riwayat servis alsintan.</p>
  </div>

  {{-- Form Tambah Riwayat Servis --}}
  <form action="{{ route('admin.service.store') }}" method="POST" class="space-y-5">
    @csrf
    <input type="hidden" name="data_alsintan_id" value="{{ $alsintan->id }}">

    {{-- Input: Tanggal & Jam Servis --}}
    <div class="flex items-center">
      <label for="service_datetime" class="w-48 text-sm font-semibold text-gray-800">Tanggal & Jam Servis</label>
      <input type="datetime-local" name="service_datetime" id="service_datetime"
        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 shadow-sm"
        required>
    </div>

    {{-- Input: Penanggung Jawab --}}
    <div class="flex items-center">
      <label for="pic" class="w-48 text-sm font-semibold text-gray-800">Penanggung Jawab</label>
      <input type="text" name="pic" id="pic" placeholder="Nama penanggung jawab"
        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 shadow-sm"
        required>
    </div>

    {{-- Input: Mekanik --}}
    <div class="flex items-center">
      <label for="mechanic" class="w-48 text-sm font-semibold text-gray-800">Mekanik</label>
      <input type="text" name="mechanic" id="mechanic" placeholder="Nama mekanik"
        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 shadow-sm"
        required>
    </div>

    {{-- Input: Catatan Servis --}}
    <div class="flex items-start">
      <label for="notes" class="w-48 text-sm font-semibold text-gray-800 pt-2">Catatan Servis</label>
      <textarea name="notes" id="notes" rows="4" placeholder="Tulis catatan servis di sini..."
        class="flex-1 block p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 shadow-sm"></textarea>
    </div>

    {{-- Tombol Simpan --}}
    <div class="flex justify-end pt-3">
      <button type="submit"
        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition">
        Simpan Riwayat Servis
      </button>
    </div>
  </form>
</x-layout>
