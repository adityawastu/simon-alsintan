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
      <!-- Kiri: Ilustrasi -->
      <div class="hidden md:flex md:w-3/4 bg-cover bg-center relative"
         style="background-image: url('/images/balai.png');">
      </div>

      <!-- Kanan: Form Login -->
      <div class="flex items-center justify-center w-full md:w-1/4 px-6 py-12 bg-white">
         <div class="w-full max-w-md">
            <div class="text-center mb-8">
               <img src="{{ asset('images/logo-mektan.png') }}" alt="Logo" class="w-20 mx-auto mb-2">
               <h2 class="text-lg text-green-600 font-semibold">Sistem Monitoring Alat Pertanian</h2>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
               @csrf
               <div>
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" name="email" id="email"
                     class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                     placeholder="Email" required>
               </div>
               <div class="relative">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>

                  <input type="password" name="password" id="password" placeholder="••••••••"
                     class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                     required>

                  {{-- Ikon Mata --}}
                  <button type="button" id="togglePassword"
                     class="absolute inset-y-0 right-3 top-6 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                     <!-- Mata Tertutup -->

                     <svg id="eyeClosed" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                     </svg>

                     <!-- Mata Terbuka (hidden default) -->

                     <svg id="eyeOpen" class="w-6 h-6 text-gray-800 dark:text-white hidden" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                           d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                     </svg>


                  </button>
               </div>

               <button type="submit"
                  class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold transition">Login</button>

               {{-- <div class="text-center text-sm mt-4">
                  <a href="#" class="text-red-500 font-semibold flex items-center justify-center gap-1">
                     🔒 Lupa Password ?
                  </a>
                  <p class="mt-1">Belum memiliki akun? <a href="#" class="text-red-500 font-bold">Register</a>
                  </p>
               </div> --}}
            </form>
         </div>
      </div>
   </div>
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
