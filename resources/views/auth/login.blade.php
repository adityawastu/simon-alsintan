<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @php
    $isProduction = app()->environment('production');
    $manifestPath = $isProduction ? '../public_html/build/manifest.json' : public_path('build/manifest.json');
  @endphp

  @if ($isProduction && file_exists($manifestPath))
    @php
      $manifest = json_decode(file_get_contents($manifestPath), true);
    @endphp
    <link rel="stylesheet" href="{{ config('app.url') }}/build/{{ $manifest['resources/css/app.css']['file'] }}">
    <script type="module" src="{{ config('app.url') }}/build/{{ $manifest['resources/js/app.js']['file'] }}"></script>
  @else
    @viteReactRefresh
    @vite(['resources/js/app.js', 'resources/css/app.css'])
  @endif
  <title>Simon Alsintan</title>
</head>

<body class="bg-gray-100">
  <div class="flex min-h-screen">

    <!-- Kiri: Ilustrasi / Banner -->
    <div class="hidden lg:flex lg:w-2/3 bg-cover bg-center relative" style="background-image: url('/images/balai.png');">

    </div>

    <!-- Kanan: Form Login -->
    <div class="flex items-center justify-center w-full lg:w-1/3 px-8 py-10 bg-white shadow-lg">
      <div class="w-full max-w-md">

        <!-- Logo & Judul -->
        <div class="text-center mb-8">
          <img src="{{ asset('images/logo-mektan.png') }}" alt="Logo" class="w-24 mx-auto mb-3">
          <h1 class="text-2xl font-bold text-green-600">Sistem Monitoring Alsintan</h1>
          <p class="text-gray-500 text-sm mt-1">Balai Mekanisasi Pertanian • Jawa Barat</p>
        </div>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
          @csrf

          <!-- Input Email -->
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" placeholder="Masukkan email"
              class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-green-500 focus:border-green-500 shadow-sm"
              required>
          </div>

          <!-- Input Password -->
          <div class="relative">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••"
              class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-green-500 focus:border-green-500 shadow-sm"
              required>

            <!-- Tombol Show / Hide Password -->
            <button type="button" id="togglePassword"
              class="absolute inset-y-0 right-3 top-7 flex items-center text-gray-500 hover:text-gray-700">
              <!-- Mata Tertutup -->
              <svg id="eyeClosed" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3.933 13.909A4.357 4.357 0 013 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0121 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 11-6 0 3 3 0 016 0Z" />
              </svg>
              <!-- Mata Terbuka -->
              <svg id="eyeOpen" class="w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z" />
              </svg>
            </button>
          </div>

          <!-- Tombol Login -->
          <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg font-semibold shadow-md transition">
            Masuk
          </button>

          <!-- Opsi Tambahan -->
          <div class="text-center text-sm mt-4">
            <a href="#" class="text-green-600 font-medium hover:underline">🔒 Lupa Password?</a>
            <p class="mt-2 text-gray-500">Belum punya akun?
              <a href="#" class="text-green-600 font-semibold hover:underline">Daftar Sekarang</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript Toggle Password -->
  <script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    togglePassword.addEventListener('click', () => {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      eyeOpen.classList.toggle('hidden', !isPassword);
      eyeClosed.classList.toggle('hidden', isPassword);
    });
  </script>
</body>

</html>
