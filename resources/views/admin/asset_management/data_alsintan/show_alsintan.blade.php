<!-- resources/views/admin/alsintan/show.blade.php -->
<x-layout>
  <!-- Tombol Kembali -->
  <a href="{{ route('admin.data.alsintan') }}"
    class="inline-flex items-center px-4 py-2 mb-5 text-sm font-medium text-white bg-green-600 rounded-lg shadow hover:bg-green-700 transition">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>

  <!-- Detail Alsintan -->
  <div class="relative p-6 shadow shadow-green-200 rounded-2xl bg-white space-y-6">
    <div class="flex flex-col lg:flex-row gap-6">
      <!-- Gambar Alsintan -->
      <div class="flex-shrink-0">
        <img src="{{ asset('storage/' . $alsintan->image) }}" alt="Gambar Alsintan"
          class="w-64 h-64 object-cover rounded-lg border border-gray-200 shadow"
          onerror="this.onerror=null;this.src='{{ asset('images/default-alat.png') }}';">
      </div>

      <!-- Informasi Alsintan -->
      <div class="flex-grow">
        <h2 class="text-2xl font-bold text-green-700 mb-4">
          {{ ucwords($alsintan->name) }}
        </h2>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3">
          <div>
            <dt class="text-gray-700 font-semibold">Deskripsi</dt>
            <dd class="text-gray-600">{{ $alsintan->description ?? '-' }}</dd>
          </div>
          <div>
            <dt class="text-gray-700 font-semibold">Kategori</dt>
            <dd class="text-gray-600">{{ $alsintan->category->name ?? '-' }}</dd>
          </div>
          <div>
            <dt class="text-gray-700 font-semibold">Merk</dt>
            <dd class="text-gray-600">{{ $alsintan->merk->name ?? '-' }}</dd>
          </div>
        </dl>

        <!-- Tombol Edit -->
        <div class="mt-5">
          <a href="{{ route('admin.alsintan.edit', $alsintan->id) }}"
            class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
              <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                clip-rule="evenodd" />
            </svg>
            Edit Alsintan
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Riwayat Servis -->
  <div class="relative p-6 shadow shadow-green-200 rounded-2xl bg-white mt-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-gray-800">Riwayat Servis Alat</h2>
      <a href="{{ route('admin.service.create', $alsintan->id) }}"
        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
        Tambah Servis
      </a>
    </div>
    <table class="w-full text-sm text-left border-collapse">
      <thead class="bg-green-100 text-green-800 font-semibold">
        <tr>
          <th class="px-4 py-3 border">Tanggal & Jam</th>
          <th class="px-4 py-3 border">Penanggung Jawab</th>
          <th class="px-4 py-3 border">Mekanik</th>
          <th class="px-4 py-3 border">Catatan Servis</th>
          <th class="px-4 py-3 border text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($alsintan->serviceHistories as $item)
          <tr class="hover:bg-green-50 transition">
            <td class="px-4 py-3 border">{{ \Carbon\Carbon::parse($item->service_datetime)->format('Y-m-d H:i') }}</td>
            <td class="px-4 py-3 border">{{ $item->pic }}</td>
            <td class="px-4 py-3 border">{{ $item->mechanic }}</td>
            <td class="px-4 py-3 border">{{ $item->notes }}</td>
            <td class="px-4 py-3 border text-center">
              <div class="flex justify-center gap-2">
                <a href="{{ route('admin.service.edit', $item->id) }}"
                  class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">Edit</a>
                <form action="{{ route('admin.service.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-4 text-gray-500">Belum ada riwayat servis</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Data Sensor & GPS -->
  <div class="relative p-6 shadow shadow-green-200 rounded-2xl bg-white mt-6">
    @if (empty($alsintan->sensor_id))
      <!-- Jika Belum Ada Sensor -->
      <div class="p-6 text-center">
        <h3 class="text-lg font-semibold text-gray-800">Belum Ada Sensor Terpasang</h3>
        <p class="text-sm text-gray-500">Pasang atau tautkan sensor untuk menampilkan data GPS & INA219.</p>
        <div class="mt-4" x-data="{ open: false }">
          <button @click="open = true" class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
            Tambahkan Sensor
          </button>

          <!-- Modal Tambah Sensor -->
          <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg border border-gray-200">
              <div class="flex items-center justify-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Hubungkan Sensor ke Alsintan</h2>
              </div>
              <form method="POST" action="{{ route('admin.alsintan.sensor.attach', $alsintan) }}">
                @csrf
                <label for="sensor_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Sensor</label>
                <select name="sensor_id" id="sensor_id"
                  class="block w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                  <option selected disabled>Pilih Sensor</option>
                  @foreach ($sensors as $sensor)
                    <option value="{{ $sensor->sensor_id }}">{{ $sensor->sensor_id }}</option>
                  @endforeach
                </select>
                <div class="flex justify-end mt-5 gap-2">
                  <button type="button" @click="open = false"
                    class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-50">Batal</button>
                  <button type="submit" class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @else
      <!-- Jika Sensor Sudah Ada -->
      @php
        $hasGps = isset($gpsData) && collect($gpsData)->isNotEmpty();
        $hasInA = isset($sensorData) && collect($sensorData)->isNotEmpty();
      @endphp

      @if (!$hasGps && !$hasInA)
        <div class="p-6 text-center rounded-lg bg-yellow-50 border border-yellow-200">
          <h3 class="text-lg font-semibold text-gray-800">Sensor Terpasang</h3>
          <p class="text-sm text-gray-600">Belum ada data terkini. Pastikan perangkat menyala & terkoneksi.</p>
        </div>
      @else
        <!-- Data GPS -->
        <div class="bg-white p-4 mb-6 border rounded-lg">
          <div class="flex justify-between items-center mb-3">
            <h2 class="text-lg font-semibold text-gray-800">Data GPS Terbaru</h2>
            <p class="text-sm text-gray-500">Last Update: {{ $hasGps ? $gpsData->first()['time'] : '-' }}</p>
          </div>
          <table class="w-full text-sm text-left">
            <thead class="bg-green-100 font-semibold text-gray-800">
              <tr>
                <th class="px-4 py-2 border">Waktu</th>
                <th class="px-4 py-2 border">Latitude</th>
                <th class="px-4 py-2 border">Longitude</th>
                <th class="px-4 py-2 border">Kecepatan (km/h)</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($gpsData as $data)
                <tr class="hover:bg-green-50 transition">
                  <td class="px-4 py-2 border">{{ $data['time'] }}</td>
                  <td class="px-4 py-2 border">{{ $data['latitude'] }}</td>
                  <td class="px-4 py-2 border">{{ $data['longitude'] }}</td>
                  <td class="px-4 py-2 border">{{ number_format($data['speed'], 2) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center py-3 text-gray-500">Belum ada data GPS.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Data Sensor INA219 -->
        <div class="bg-white p-4 rounded-lg">
          <div class="flex justify-between items-center mb-3">
            <h2 class="text-lg font-semibold text-gray-800">Data Sensor INA219</h2>
            <span class="text-sm text-gray-500">
              Last Update: <strong>{{ $hasInA ? $sensorData->first()['time'] : '-' }}</strong>
            </span>
          </div>
          <table class="w-full text-sm text-center border">
            <thead class="bg-green-100 text-green-800 font-semibold">
              <tr>
                <th class="py-2 px-4 border">Waktu</th>
                <th class="py-2 px-4 border">Bus Voltage (V)</th>
                <th class="py-2 px-4 border">Shunt Voltage (V)</th>
                <th class="py-2 px-4 border">Load Voltage (V)</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($sensorData as $row)
                <tr class="hover:bg-green-50 transition">
                  <td class="py-2 px-4 border">{{ $row['time'] }}</td>
                  <td class="py-2 px-4 border">{{ $row['bus'] }}</td>
                  <td class="py-2 px-4 border">{{ $row['shunt'] }}</td>
                  <td class="py-2 px-4 border">{{ $row['load'] }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="py-3 px-4 text-center text-gray-500">Belum ada data sensor.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Tombol Hapus Sensor -->
        <div class="mt-5">
          <form method="POST" action="{{ route('admin.alsintan.sensor.detach', $alsintan) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
              Hapus Sensor {{ $alsintan->sensor_id }}
            </button>
          </form>
        </div>
      @endif
    @endif
  </div>
</x-layout>
