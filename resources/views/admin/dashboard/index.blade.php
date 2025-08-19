<x-layout>
   <div class="p-6">
      <h1 class="text-2xl font-bold text-green-600 mb-6">Dashboard Aplikasi</h1>

      {{-- Kartu ringkasan --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
         <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-600">
            <p class="text-sm text-gray-500 mb-1">Total Alat dan Mesin Pertanian</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalAlsintan }}</p>
         </div>
         <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-600">
            <p class="text-sm text-gray-500 mb-1">Mesin yang sedang berjalan</p>
            <p class="text-3xl font-bold text-gray-800">{{ $runningAlsintan }}</p>
         </div>
         <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-600">
            <p class="text-sm text-gray-500 mb-1">Total UPJA</p>
            <p class="text-3xl font-bold text-gray-800">{{ $runningAlsintan }}</p>
         </div>
      </div>


      {{-- Grafik --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
         <!-- Grafik Kiri -->
         <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">
               Jumlah alat mesin dan pertanian
            </h2>
            <canvas id="alsintanChart" width="400" height="200"></canvas>
         </div>

         <!-- Grafik Kanan -->
         <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">
               Jumlah Upja provinsi Jawa Barat
            </h2>
            <canvas id="alsintanChart2" width="400" height="200"></canvas>
         </div>
      </div>
   </div>

   {{-- Chart.js CDN --}}
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
               backgroundColor: 'rgba(34, 197, 94, 0.5)', // Tailwind green
               borderColor: 'rgba(34, 197, 94, 1)',
               borderWidth: 1
            }]
         },
         options: {
            responsive: true,
            scales: {
               y: {
                  beginAtZero: true,
                  ticks: {
                     precision: 0
                  }
               }
            }
         }
      });
   </script>
</x-layout>
