<x-layout>
  <a href="{{ url()->previous() }}"
    class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-700 rounded hover:bg-green-800">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>

  <div class="flex items-center justify-between mb-4">
    <h1 class="text-black text-xl">Lokasi Real Time {{ $alat->name ?? 'Mesin' }}</h1>
    <span id="realtime-clock" class="text-sm text-gray-600"></span>
  </div>

  <div id="map" class="w-full h-[400px] rounded shadow mb-6"></div>

  <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-10">
    {{-- Kecepatan Saat Ini --}}
    <x-monitoring.card icon="fas fa-tachometer-alt" label="Kecepatan Saat Ini"
      value="{{ number_format($latestData->speed ?? 0, 2) . ' km/h' }}" />

    {{-- Kecepatan Rata-rata --}}
    <x-monitoring.card icon="fas fa-tachometer-alt" label="Kecepatan Rata-rata"
      value="{{ number_format($averageSpeed ?? 0, 2) . ' km/h' }}" />

    {{-- Total Jarak --}}
    <x-monitoring.card icon="fas fa-road" label="Total Jarak" value="{{ number_format($totalDistance ?? 0, 2) . ' km' }}" />

    {{-- Tegangan Bus --}}
    <x-monitoring.card icon="fas fa-battery-half" label="Tegangan Bus"
      value="{{ number_format($latestData->busvoltage ?? 0, 2) . ' V' }}" />

    {{-- Kecepatan Maksimum --}}
    <x-monitoring.card icon="fas fa-chart-line" label="Kecepatan Maksimum" value="{{ number_format($maxSpeed ?? 0, 2) . ' km/h' }}" />

    {{-- Durasi Penggunaan --}}
    <x-monitoring.card icon="fas fa-clock" label="Durasi Penggunaan" value="{{ $usageDuration ?? '00:00:00' }}" />
  </div>

  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Ambil data lat dan lng dari database, fallback ke Bandung jika null
      var lat = {{ $latestData->lat ?? -6.917464 }};
      var lng = {{ $latestData->lng ?? 107.619123 }};
      var speed = '{{ number_format($latestData->speed ?? 0, 2) }}';

      // Inisialisasi peta
      var map = L.map('map').setView([lat, lng], 15);

      // Tambahkan tile layer
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(map);

      // Tambahkan marker
      L.marker([lat, lng])
        .addTo(map)
        .bindPopup('Lokasi terakhir<br>Speed: ' + speed + ' km/h')
        .openPopup();
    });

    // Realtime Clock
    function updateClock() {
      const now = new Date();
      const options = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false,
      };
      const timeString = now.toLocaleTimeString('id-ID', options);
      document.getElementById('realtime-clock').textContent = `Waktu: ${timeString}`;
    }

    setInterval(updateClock, 1000);
    updateClock();
  </script>

  <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
</x-layout>
