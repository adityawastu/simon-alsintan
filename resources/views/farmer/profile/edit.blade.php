<x-layout>
  {{-- Tombol Kembali --}}
  <a href="{{ route('farmer.profile.show') }}"
    class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 transition">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>

  <div class="h-full sm:h-auto">
    <div class="relative p-3 mb-3 sm:p-5">
      {{-- Header --}}
      <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
        <h1 class="text-2xl font-semibold text-gray-900">
          Edit Profil Petani
        </h1>
        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-700">
          {{ ucfirst($user->role ?? 'Farmer') }}
        </span>
      </div>

      {{-- Form Edit Farmer Profile --}}
      <form action="{{ route('farmer.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="gap-6 mb-4 sm:grid-cols-2">
          {{-- No. KTP --}}
          <div class="mb-4 flex items-center">
            <label for="no_ktp" class="w-40 text-sm font-semibold text-gray-800">No. KTP</label>
            <input type="text" name="no_ktp" id="no_ktp" value="{{ old('no_ktp', $profile->no_ktp) }}"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-green-500 focus:border-green-500 p-2.5"
              required>
          </div>
          {{-- Kontak --}}
          <div class="mb-4 flex items-center">
            <label for="kontak" class="w-40 text-sm font-semibold text-gray-800">Kontak</label>
            <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $profile->kontak) }}"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-green-500 focus:border-green-500 p-2.5"
              required>
          </div>

          {{-- Alamat --}}
          <div class="mb-4 flex items-start">
            <label for="alamat" class="w-40 text-sm font-semibold text-gray-800 pt-2">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3"
              class="flex-1 block p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                     focus:ring-green-500 focus:border-green-500"
              required>{{ old('alamat', $profile->alamat) }}</textarea>
          </div>

          {{-- Desa --}}
          <div class="mb-4 flex items-center">
            <label for="desa" class="w-40 text-sm font-semibold text-gray-800">Desa</label>
            <input type="text" name="desa" id="desa" value="{{ old('desa', $profile->desa) }}"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-green-500 focus:border-green-500 p-2.5"
              required>
          </div>

          {{-- Kecamatan --}}
          <div class="mb-4 flex items-center">
            <label for="kecamatan" class="w-40 text-sm font-semibold text-gray-800">Kecamatan</label>
            <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan', $profile->kecamatan) }}"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-green-500 focus:border-green-500 p-2.5"
              required>
          </div>

          {{-- Kabupaten --}}
          <div class="mb-4 flex items-center">
            <label for="kabupaten" class="w-40 text-sm font-semibold text-gray-800">Kabupaten</label>
            <input type="text" name="kabupaten" id="kabupaten" value="{{ old('kabupaten', $profile->kabupaten) }}"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-green-500 focus:border-green-500 p-2.5"
              required>
          </div>

          {{-- Provinsi --}}
          <div class="mb-4 flex items-center">
            <label for="provinsi" class="w-40 text-sm font-semibold text-gray-800">Provinsi</label>
            <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', $profile->provinsi) }}"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-green-500 focus:border-green-500 p-2.5"
              required>
          </div>

          {{-- Luas Lahan --}}
          <div class="mb-4 flex items-center">
            <label for="luas_lahan" class="w-40 text-sm font-semibold text-gray-800">Luas Lahan (ha)</label>
            <input type="number" step="0.01" name="luas_lahan" id="luas_lahan" value="{{ old('luas_lahan', $profile->luas_lahan) }}"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-green-500 focus:border-green-500 p-2.5">
          </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end mt-4">
          <button
            type="submit"class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</x-layout>
