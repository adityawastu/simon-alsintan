<x-layout>
  <a href="{{ route('admin.data.alsintan') }}"
    class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 transition">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>

  <div class="h-full sm:h-auto">
    <div class="relative p-3 mb-3 sm:p-5">
      <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
        <h1 class="text-2xl font-semibold text-gray-900">
          Tambah Data Alsintan
        </h1>
      </div>

      <form action="{{ route('admin.alsintan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="gap-6 mb-4 sm:grid-cols-2">

          {{-- Nama Alsintan --}}
          <div class="mb-4 flex items-center">
            <label for="name" class="w-40 text-sm font-semibold text-gray-800">
              Nama Alsintan
            </label>
            <input type="text" name="name" id="name"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5"
              placeholder="Masukkan nama alsintan" required>
          </div>

          {{-- Kategori Alsintan --}}
          <div class="mb-4 flex items-center">
            <label for="category" class="w-40 text-sm font-semibold text-gray-800">
              Kategori Alsintan
            </label>
            <select id="category" name="category_id"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
              <option selected disabled>Pilih Kategori</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          {{-- Merk --}}
          <div class="mb-4 flex items-center">
            <label for="merk" class="w-40 text-sm font-semibold text-gray-800">
              Merk
            </label>
            <select id="merk" name="merk_id"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5">
              <option selected disabled>Pilih Merk</option>
              @foreach ($merks as $merk)
                <option value="{{ $merk->id }}">{{ $merk->name }}</option>
              @endforeach
            </select>
          </div>

          {{-- Deskripsi --}}
          <div class="mb-4 flex items-start">
            <label for="description" class="w-40 text-sm font-semibold text-gray-800 pt-2">
              Deskripsi
            </label>
            <textarea id="description" name="description" rows="4"
              class="flex-1 block p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
              placeholder="Tulis deskripsi produk di sini..."></textarea>
          </div>

          {{-- Upload Gambar --}}
          <div class="mb-4 flex items-start">
            <label class="w-40 text-sm font-semibold text-gray-800 pt-2">
              Upload Gambar
            </label>
            <div class="flex-1">
              <div id="drop-area"
                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-green-400 transition">
                <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="handleFiles(this.files)">
                <div class="flex flex-col items-center justify-center">
                  <p class="text-gray-600 font-medium">Klik untuk upload gambar</p>
                  <p class="text-xs text-gray-400">SVG, PNG, JPG, atau GIF (Maks. 800x400px) • 1:1 Ratio</p>
                </div>
              </div>
              <div class="mt-2 hidden" id="borderLabel">
                <div id="previewContainer" class="relative flex gap-4 items-start">
                  <img id="preview" class="w-40 h-40 object-cover rounded-lg border border-gray-300 shadow">
                  <div class="flex flex-col text-sm text-gray-700">
                    <p><strong>File:</strong> <span id="fileName">-</span></p>
                    <p><strong>Ukuran:</strong> <span id="fileSize">-</span></p>
                    <p><strong>Tipe:</strong> <span id="fileType">-</span></p>
                  </div>
                  <button id="removeImage" type="button"
                    class="absolute top-1 right-1 bg-white rounded-full p-1 shadow hover:bg-red-50 transition">
                    <svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end mt-4">
          <button type="submit"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- JavaScript untuk Upload Gambar --}}
  <script>
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("image");

    dropArea.addEventListener("click", () => fileInput.click());
    dropArea.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropArea.classList.add("border-green-400");
    });
    dropArea.addEventListener("dragleave", () => {
      dropArea.classList.remove("border-green-400");
    });
    dropArea.addEventListener("drop", (e) => {
      e.preventDefault();
      dropArea.classList.remove("border-green-400");
      handleFiles(e.dataTransfer.files);
    });

    function handleFiles(files) {
      if (files.length > 0) {
        let file = files[0];
        let reader = new FileReader();
        reader.onload = function() {
          document.getElementById("preview").src = reader.result;
          document.getElementById("borderLabel").classList.remove("hidden");
          document.getElementById("fileName").textContent = file.name;
          document.getElementById("fileSize").textContent = (file.size / 1024).toFixed(2) + " KB";
          document.getElementById("fileType").textContent = file.type;
          dropArea.classList.add("hidden");
        };
        reader.readAsDataURL(file);
      }
    }

    document.getElementById("removeImage").addEventListener("click", function() {
      document.getElementById("preview").src = "";
      document.getElementById("borderLabel").classList.add("hidden");
      fileInput.value = "";
      dropArea.classList.remove("hidden");
    });
  </script>
</x-layout>
