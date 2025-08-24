<x-layout>
  <div class="flex flex-wrap md:flex-nowrap items-center justify-between md:gap-x-4">
    <div class="w-full sm:w-1/2 md:w-1/4 mb-4 md:mb-0">
      <img src="{{ asset('images/beranda.png') }}" alt="Ilustrasi Mekanisasi" class="w-full h-auto rounded-lg" />
    </div>
    <div class="w-full sm:w-1/2 md:w-3/4 ">
      <h2 class="text-2xl font-bold mb-2 text-green-700 dark:text-gray-200">Sistem Mekanisasi Pertanian</h2>
      <p class="text-base text-black dark:text-gray-200">Hi <span class="font-bold"> {{ Auth::user()->name }},</span>
        Selamat datang di Sistem Mekanisasi Pertanian, sebuah platform inovatif yang dirancang untuk
        mendukung transformasi pertanian menuju era modern yang efisien dan berbasis teknologi.
        Melalui integrasi data dan pemantauan alat secara real-time, kami membantu petani dan pelaku
        sektor pertanian mengelola peralatan dengan lebih cerdas, meningkatkan produktivitas lahan,
        serta membuat keputusan yang tepat berbasis analisis. Dengan dukungan teknologi seperti IoT
        dan dashboard interaktif, sistem ini hadir sebagai solusi praktis dalam mewujudkan pertanian
        presisi dan berkelanjutan.
      </p>
    </div>
  </div>
</x-layout>
