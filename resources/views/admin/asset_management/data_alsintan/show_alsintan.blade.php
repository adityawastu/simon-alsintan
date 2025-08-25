<x-layout>
  <a href="{{ route('admin.data.alsintan') }}"
    class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-700 hover:bg-green-800">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>
  {{-- deskripsi alat --}}
  <div class="relative p-4 h-full shadow shadow-green-200 rounded-2xl md:h-auto">
    <div>
      <!-- Modal content -->
      <div class="relative p-4 sm:p-5">
        <div class="flex flex-col lg:flex-row gap-6 items-start">
          <!-- Gambar di kiri -->
          <div class="flex-shrink-0">
            <img src="{{ asset('storage/' . $alsintan->image) }}" alt="Gambar Alsintan" class="w-64 h-64 object-cover rounded-lg"
              onerror="this.onerror=null;this.src='{{ asset('images/default-alat.png') }}';">
          </div>

          <!-- Keterangan di kanan -->
          <div class="flex-grow">
            <div class="mb-4">
              {{-- <h3 class="text-2xl font-semibold text-gray-900">
                        {{ ucwords($alsintan->name) }}
                     </h3> --}}
            </div>
            <dl>
              <dt class="mb-2 font-semibold leading-none text-gray-900">Deskripsi</dt>
              <dd class="mb-4 font-light text-gray-500 sm:mb-5">{{ $alsintan->description ?? '-' }}</dd>
              <dt class="mb-2 font-semibold leading-none text-gray-900">Kategori</dt>
              <dd class="mb-4 font-light text-gray-500 sm:mb-5">{{ $alsintan->category->name ?? '-' }}</dd>
              <dt class="mb-2 font-semibold leading-none text-gray-900">Merk</dt>
              <dd class="mb-4 font-light text-gray-500 sm:mb-5">{{ $alsintan->merk->name ?? '-' }}</dd>
            </dl>

            <!-- Tombol Edit -->
            <div class="flex items-center space-x-4 mt-4">
              <a href="{{ route('admin.alsintan.edit', $alsintan->id) }}" type="button"
                class="text-white inline-flex items-center bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                  <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                    clip-rule="evenodd" />
                </svg>
                Edit
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- data servis --}}
  <div class="relative p-4 h-full shadow shadow-green-200 rounded-2xl mt-5 md:h-auto">
    <div class="flex justify-between items-center mb-3">
      <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
        Riwayat Servis Alat Tani
      </h2>
    </div>
    <table class="w-full text-sm text-left border-collapse">
      <thead class="bg-green-100 text-black font-semibold">
        <tr>
          <th class="py-2 px-4 border">Tanggal & Jam</th>
          <th class="py-2 px-4 border">Penanggung Jawab</th>
          <th class="py-2 px-4 border">Mekanik</th>
          <th class="py-2 px-4 border">Catatan Servis</th>
          <th class="py-2 px-4 border text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($alsintan->serviceHistories as $item)
          <tr class="hover:bg-green-50">
            <td class="py-2 px-4 border">
              {{ \Carbon\Carbon::parse($item->service_datetime)->format('Y-m-d H:i') }}
            </td>
            <td class="py-2 px-4 border">{{ $item->pic }}</td>
            <td class="py-2 px-4 border">{{ $item->mechanic }}</td>
            <td class="py-2 px-4 border">{{ $item->notes }}</td>
            <td class="py-2 px-4 border text-center">
              <div class="flex justify-center gap-2">
                <a href="{{ route('admin.service.edit', $item->id) }}"
                  class="px-3 py-1 text-sm text-white bg-green-600 rounded hover:bg-green-700">
                  Edit
                </a>
                <form action="{{ route('admin.service.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                    Delete
                  </button>
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

    <div class="relative p-4 sm:p-5">
      <!-- Modal header -->
      <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
        <div class="col-span-4">
          <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3 sm:space-x-4">
              <a href="{{ route('admin.service.create', $alsintan->id) }}" type="button"
                class="text-white inline-flex items-center bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                  </path>
                  <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                    clip-rule="evenodd"></path>
                </svg>
                Tambah data service
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  {{-- data gps & dan sensor --}}
  <div class="relative p-4 h-full shadow shadow-green-200 rounded-2xl mt-5 md:h-auto">
    {{-- === Kondisi: belum ada sensor terpasang === --}}
    @if (empty($alsintan->sensor_id))
      <div class="p-8 mt-5 text-center bg-white rounded-xl border-gray-300">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Sensor Terpasang</h3>
        <p class="text-sm text-gray-600 mb-5">
          Pasang atau tautkan sensor untuk mulai menampilkan data GPS & INA219.
        </p>

        {{-- Flash message --}}
        @if (session('success'))
          <div class="mb-3 rounded-lg bg-green-100 text-green-800 px-4 py-2">{{ session('success') }}</div>
        @endif
        @if (session('error'))
          <div class="mb-3 rounded-lg bg-red-100 text-red-800 px-4 py-2">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
          <div class="mb-3 rounded-lg bg-red-100 text-red-800 px-4 py-2">
            {{ $errors->first() }}
          </div>
        @endif

        {{-- Section Attach Sensor --}}
        <div x-data="{ open: false }">
          <button type="button" class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition"
            @click="open = true">
            Tambahkan Sensor
          </button>

          {{-- Modal Attach Sensor --}}
          <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl border border-gray-200">
              <div class="flex items-center justify-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Hubungkan Sensor ke Alsintan</h2>
              </div>

              <form method="POST" action="{{ route('admin.alsintan.sensor.attach', $alsintan) }}">
                @csrf
                <label for="sensor_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Sensor</label>
                <select name="sensor_id" id="sensor_id"
                  class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                  <option selected disabled>Pilih Sensor</option>
                  @foreach ($sensors as $sensor)
                    <option value="{{ $sensor->sensor_id }}" {{ old('sensor_id') == $sensor->sensor_id ? 'selected' : '' }}>
                      {{ $sensor->sensor_id }}
                    </option>
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

        {{-- CSS anti “kedip” Alpine --}}
        <style>
          [x-cloak] {
            display: none !important;
          }
        </style>
      </div>
    @else
      {{-- === Kondisi: sensor ada === --}}
      <div class="">

      </div>
      @php
        $hasGps = isset($gpsData) && collect($gpsData)->isNotEmpty();
        $hasInA = isset($sensorData) && collect($sensorData)->isNotEmpty();
      @endphp

      @if (!$hasGps && !$hasInA)
        <div class="p-6 mt-5 rounded-2xl border bg-white text-center">
          <h3 class="text-lg font-semibold text-gray-800 mb-1">Sensor Terpasang</h3>
          <p class="text-sm text-gray-600">Belum ada data terkini dari sensor. Pastikan perangkat menyala &
            terkoneksi.</p>
          <div class="mt-3 text-xs text-gray-500">
            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-yellow-100 text-yellow-800">
              <span class="w-2 h-2 rounded-full bg-yellow-500"></span> Waiting for data…
            </span>
          </div>
        </div>
      @else
        {{-- === Sensor ada & ada data === --}}
        <div class="relative p-4 h-full mt-5 md:h-auto">
          {{-- Data GPS --}}
          <div class="bg-white p-4 mb-6">
            <div class="flex justify-between items-center mb-2">
              <h2 class="text-lg font-semibold text-gray-800">Data GPS Terbaru</h2>
              <p class="text-sm text-gray-600">Last Update: {{ $hasGps ? $gpsData->first()['time'] : '-' }}</p>
            </div>
            <table class="w-full text-sm text-left text-gray-700 border rounded-lg">
              <thead class="bg-green-100 font-bold text-gray-800">
                <tr>
                  <th class="px-4 py-2">Waktu</th>
                  <th class="px-4 py-2">Latitude</th>
                  <th class="px-4 py-2">Longitude</th>
                  <th class="px-4 py-2">Speed (km/h)</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($gpsData as $data)
                  <tr class="border-t hover:bg-green-50">
                    <td class="px-4 py-2">{{ $data['time'] }}</td>
                    <td class="px-4 py-2">{{ $data['latitude'] }}</td>
                    <td class="px-4 py-2">{{ $data['longitude'] }}</td>
                    <td class="px-4 py-2">{{ number_format($data['speed'], 2) }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">Belum ada data GPS.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- Data Sensor INA219 --}}
          <div class="bg-white p-4 ">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-lg font-semibold text-gray-800">Data Sensor INA219 Terbaru</h2>
              <span class="text-sm text-gray-500">
                Last Update: <strong>{{ $hasInA ? $sensorData->first()['time'] : '-' }}</strong>
              </span>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full text-sm text-center border rounded-lg">
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
                    <tr class="bg-white hover:bg-green-50">
                      <td class="py-2 px-4 border">{{ $row['time'] }}</td>
                      <td class="py-2 px-4 border">{{ $row['bus'] }}</td>
                      <td class="py-2 px-4 border">{{ $row['shunt'] }}</td>
                      <td class="py-2 px-4 border">{{ $row['load'] }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="py-3 px-4 text-center text-gray-500">Belum ada data sensor.
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          {{-- hapus sensor --}}
          <div class="flex items-center space-x-3 mt-5 sm:space-x-4">
            <form method="POST" action="{{ route('admin.alsintan.sensor.detach', $alsintan) }}" class="mt-5">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="text-white inline-flex items-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Hapus sensor {{ $alsintan->sensor_id }}
              </button>
            </form>
          </div>
        </div>
      @endif
    @endif
  </div>





</x-layout>
