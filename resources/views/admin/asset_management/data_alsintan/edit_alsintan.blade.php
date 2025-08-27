<x-layout>
  <a href="{{ url()->previous() }}"
    class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium text-white bg-green-700 rounded hover:bg-green-800">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>

  <div class="h-full sm:h-auto">
    <div class="relative p-4 mb-3 rounded-lg shadow sm:p-5">
      <div class="flex justify-between items-center pb-4 mb-4 rounded-t sm:mb-5">
        <h3 class="text-lg font-semibold text-gray-900">
          Edit Data Alsintan
        </h3>
      </div>

      <form action="{{ route('admin.alsintan.update', $alsintan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="gap-6 mb-4 sm:grid-cols-2">
          {{-- Nama Alsintan --}}
          <div class="mb-2 flex items-center">
            <label for="name" class="w-40 text-sm font-bold text-gray-900">
              Nama Alsintan
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $alsintan->name) }}"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5"
              placeholder="Masukkan nama alsintan" required>
          </div>

          {{-- Kategori --}}
          <div class="mb-2 flex items-center">
            <label for="category" class="w-40 text-sm font-bold text-gray-900">
              Kategori Alsintan
            </label>
            <select id="category" name="category_id"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5">
              <option>Pilih Kategori</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $alsintan->category_id) == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Merk --}}
          <div class="mb-2 flex items-center">
            <label for="merk" class="w-40 text-sm font-bold text-gray-900">
              Merk
            </label>
            <select id="merk" name="merk_id"
              class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5">
              <option>Pilih Merk</option>
              @foreach ($merks as $merk)
                <option value="{{ $merk->id }}" {{ old('merk_id', $alsintan->merk_id) == $merk->id ? 'selected' : '' }}>
                  {{ $merk->name }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Deskripsi --}}
          <div class="mb-2 flex items-start">
            <label for="description" class="w-40 text-sm font-bold text-gray-900 mt-2">
              Deskripsi
            </label>
            <textarea id="description" name="description" rows="4"
              class="flex-1 p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
              placeholder="Tulis deskripsi produk disini">{{ old('description', $alsintan->description) }}</textarea>
          </div>

          {{-- Preview Gambar Lama --}}
          @if ($alsintan->image)
            <div class="mb-4 flex items-start">
              <label class="w-40 text-sm font-bold text-gray-900 mt-2">
                Gambar Saat Ini
              </label>
              <img src="{{ asset('storage/' . $alsintan->image) }}" class="w-40 h-40 object-cover rounded-lg shadow">
            </div>
          @endif

          {{-- Upload Gambar Baru --}}
          <div class="mb-2 flex items-start">
            <label class="w-40 text-sm font-bold text-gray-900 mt-2">
              Upload Gambar Baru
            </label>
            <div class="flex-1">
              <div id="drop-area"
                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer mt-2 hover:border-gray-400 transition mb-2">
                <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="handleFiles(this.files)">
                <div class="flex flex-col items-center justify-center">
                  <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0 0V8m0 4h4m-4 0H8m4-4a4 4 0 110 8 4 4 0 010-8z" />
                  </svg>
                  <p class="text-gray-600"><b>Klik untuk upload</b> atau drag & drop</p>
                  <p class="text-xs text-gray-400">SVG, PNG, JPG, atau GIF (MAX. 800x400px)</p>
                </div>
              </div>

              {{-- Preview Upload Baru --}}
              <div id="borderLabel" class="border-2 border-dashed border-gray-300 rounded-lg p-4 hidden">
                <div id="previewContainer" class="relative grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 items-center">
                  <div class="col-span-1">
                    <img id="preview" class="w-40 h-40 object-cover rounded-lg">
                    <button id="removeImage" type="button"
                      class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center shadow-lg hover:bg-red-600">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke-width="2" stroke="currentColor"
                        class="w-4 h-4">
                        <path fill-rule="evenodd"
                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                          clip-rule="evenodd"></path>
                      </svg>
                    </button>
                  </div>
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

        {{-- Tombol Simpan --}}
        <div class="flex justify-end mt-6">
          <button type="submit"
            class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm8 2a1 1 0 10-2 0v3H6a1 1 0 100 2h3v3a1 1 0 102 0v-3h3a1 1 0 100-2h-3V6z"
                clip-rule="evenodd"></path>
            </svg>
            Update Data Alsintan
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const dropArea = document.getElementById("drop-area");
    const fileInput = document.getElementById("image");
    const preview = document.getElementById("preview");

    dropArea.addEventListener("click", () => fileInput.click());

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
          preview.src = reader.result;
          document.getElementById("borderLabel").classList.remove("hidden");
          document.getElementById("fileLabel").classList.remove("hidden");

          document.getElementById("fileName").textContent = file.name;
          document.getElementById("fileSize").textContent = (file.size / 1024).toFixed(2) + " KB";
          document.getElementById("fileType").textContent = file.type;
        };
        reader.readAsDataURL(file);
      }
    }

    document.getElementById("removeImage").addEventListener("click", function() {
      preview.src = "";
      document.getElementById("borderLabel").classList.add("hidden");
      document.getElementById("fileLabel").classList.add("hidden");
      fileInput.value = "";
      document.getElementById("fileName").textContent = "-";
      document.getElementById("fileSize").textContent = "-";
      document.getElementById("fileType").textContent = "-";
    });
  </script>
</x-layout>
