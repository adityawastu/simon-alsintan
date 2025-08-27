<!-- resources/views/admin/dashboard.blade.php -->
<x-layout>
  <div class="p-6 space-y-8">

    <!-- Judul Halaman -->
    <h1 class="text-3xl font-bold text-green-600 tracking-wide">
      Dashboard Aplikasi
    </h1>

    <!-- Kartu Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Total Alsintan -->
      <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-600 hover:shadow-lg transition duration-300">
        <p class="text-sm text-gray-500 mb-1">Total Alat & Mesin Pertanian</p>
        <p class="text-3xl font-bold text-gray-800">{{ $totalAlsintan }}</p>
      </div>

      <!-- Mesin Berjalan -->
      <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-600 hover:shadow-lg transition duration-300">
        <p class="text-sm text-gray-500 mb-1">Mesin yang Sedang Berjalan</p>
        <p class="text-3xl font-bold text-gray-800">{{ $runningAlsintan }}</p>
      </div>

      <!-- Total UPJA -->
      <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-600 hover:shadow-lg transition duration-300">
        <p class="text-sm text-gray-500 mb-1">Total UPJA</p>
        <p class="text-3xl font-bold text-gray-800">{{ $runningAlsintan }}</p>
      </div>
    </div>

    <!-- Grafik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Grafik Jumlah Alsintan -->
      <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">
          Jumlah Alat & Mesin Pertanian
        </h2>
        <canvas id="alsintanChart" width="400" height="200"></canvas>
      </div>

      <!-- Grafik Jumlah UPJA -->
      <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">
          Jumlah UPJA Provinsi Jawa Barat
        </h2>
        <canvas id="alsintanChart2" width="400" height="200"></canvas>
      </div>
    </div>
  </div>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('alsintanChart').getContext('2d');
    const alsintanChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @json($labels),
        datasets: [{
          label: 'Jumlah Alsintan',
          data: @json($data),
          backgroundColor: 'rgba(34, 197, 94, 0.5)',
          borderColor: 'rgba(34, 197, 94, 1)',
          borderWidth: 1,
          borderRadius: 5
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            labels: {
              color: '#374151'
            }
          }
        },
        scales: {
          x: {
            ticks: {
              color: '#4B5563'
            }
          },
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0,
              color: '#4B5563'
            },
            grid: {
              color: '#E5E7EB'
            }
          }
        }
      }
    });
  </script>
</x-layout>
