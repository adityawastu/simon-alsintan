<x-layout>
  <a href="{{ route('admin.data.alsintan') }}"
    class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-700 rounded hover:bg-green-800">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>
  <div class="h-full sm:h-auto">
    <!-- Modal content -->
    <div class="relative p-3 mb-3 sm:p-5">
      <!-- Modal header -->
      <div class="flex justify-between items-center pb-4 mb-4 rounded-t sm:mb-1">
        <h1 class="text-2xl font-semibold text-gray-900">
          Tambah Data Alsintan
        </h1>
      </div>
      <form action="{{ route('admin.alsintan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="gap-6 mb-4
                sm:grid-cols-2">
          {{-- nama --}}
          <div class="mb-2 flex items-center">
            <label for="name" class="w-40 text-sm font-bold text-gray-900">
              Nama Alsintan
            </label>
            <input type="text" name="name" id="name"
              class="flex-1 bg-gray-50 border border-gray-300 text-red-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5"
              placeholder="Masukkan nama alsintan" required>
          </div>
          {{-- sensor --}}
          <div class="mb-2">
            <label for="sensor_id" class="block mb-2 text-sm font-medium text-gray-900">Sensor</label>
            <select id="sensor_id" name="sensor_id"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
              <option selected disabled>Pilih Sensor</option>
              @foreach ($sensors as $sensor)
                <option value="{{ $sensor->sensor_id }}" {{ old('sensor_id') == $sensor->sensor_id ? 'selected' : '' }}>
                  {{ $sensor->sensor_id }}
                </option>
              @endforeach
            </select>
          </div>
          {{-- jenis --}}
          <div class="mb-2">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Kategori
              Alsintan</label>
            <select id="category" name="category_id"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
              <option selected="">Pilih jenis Kategori</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>

          </div>
          {{-- merk --}}
          <div class="mb-2">
            <label for="merk" class="block mb-2 text-sm font-medium text-gray-900">Merk</label>
            <select id="merk" name="merk_id"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
              <option selected="">Pilih Merk alat</option>
              @foreach ($merks as $merk)
                <option value="{{ $merk->id }}">{{ $merk->name }}</option>
              @endforeach
            </select>
          </div>

          {{-- deskripsi --}}
          <div class="mb-2">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
              placeholder="Tulis produk deskripsi disini"></textarea>
          </div>
          {{-- upload gambar --}}
          <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700">Upload Gambar</label>
            <div id="drop-area"
              class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer mt-2 hover:border-gray-400 transition mb-2">
              <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="handleFiles(this.files)">

              <div class="flex flex-col items-center justify-center">
                <p class="text-gray-600"><b>Click untuk upload gambar</p>
                <p class="text-xs text-gray-400">SVG, PNG, JPG, or GIF (MAX. 800x400px) only 1 x 1</p>
              </div>

              <!-- Preview Gambar -->

            </div>
            <div class="mb-2">
              <p id="fileLabel" class="text-sm font-medium text-gray-700 mb-1 hidden"></p>
              <div id="borderLabel" class="border-2 border-dashed border-gray-300 rounded-lg p-4 hidden">
                <div id="previewContainer" class="relative grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 items-center ">
                  <!-- Preview Gambar -->
                  <div class="col-span-1">
                    <img id="preview" class="w-40 h-40 object-cover rounded-lg">
                    <button id="removeImage" type="button" class="absolute top-1 right-1  flex items-center justify-center shadow-lg ">
                      <svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                      </svg>
                    </button>
                  </div>
                  <!-- Informasi File -->
                  <div class="text-sm text-gray-700 col-span-5">
                    <p><strong>File:</strong> <span id="fileName">-</span></p>
                    <p><strong>Ukuran:</strong> <span id="fileSize">-</span></p>
                    <p><strong>Tipe:</strong> <span id="fileType">-</span></p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="flex justify-end"> <button type="submit"
        class="text-white inline-flex items-center  bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Simpan
      </button></div>

    </form>
  </div>
  </div>
  <script>
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("image");
    const preview = document.getElementById("preview");

    // Saat klik area, buka file picker
    dropArea.addEventListener("click", () => fileInput.click());

    // Drag & Drop
    dropArea.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropArea.classList.add("border-gray-400");
    });

    dropArea.addEventListener("dragleave", () => {
      dropArea.classList.remove("border-gray-400");
    });

    dropArea.addEventListener("drop", (e) => {
      e.preventDefault();
      dropArea.classList.remove("border-gray-400");
      handleFiles(e.dataTransfer.files);
    });

    function handleFiles(files) {
      if (files.length > 0) {
        let file = files[0];
        let reader = new FileReader();

        reader.onload = function() {
          // tampilkan preview & info
          document.getElementById("preview").src = reader.result;
          document.getElementById("borderLabel").classList.remove("hidden");
          document.getElementById("fileLabel").classList.remove("hidden");

          document.getElementById("fileName").textContent = file.name;
          document.getElementById("fileSize").textContent = (file.size / 1024).toFixed(2) + " KB";
          document.getElementById("fileType").textContent = file.type;

          // >>> sembunyikan area upload supaya tidak menimpa
          document.getElementById("drop-area").classList.add("hidden");
        };
        reader.readAsDataURL(file);
      }
    }

    // Fungsi untuk menghapus gambar dan informasi file
    document.getElementById("removeImage").addEventListener("click", function() {
      document.getElementById("preview").src = "";
      document.getElementById("borderLabel").classList.add("hidden");
      document.getElementById("fileLabel").classList.add("hidden");
      document.getElementById("image").value = "";

      document.getElementById("fileName").textContent = "-";
      document.getElementById("fileSize").textContent = "-";
      document.getElementById("fileType").textContent = "-";

      // >>> tampilkan kembali area upload
      document.getElementById("drop-area").classList.remove("hidden");
    });
  </script>
</x-layout>
