<div id="peminjamanApprovalModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg relative">
    <!-- Header -->
    <h2 class="text-xl font-semibold mb-4">Detail Peminjaman</h2>

    <!-- Detail Peminjam -->
    <div class="space-y-2 mb-4">
      <p><span class="font-semibold">Nama Peminjam:</span> <span id="modalNamaPeminjam"></span></p>
      <p><span class="font-semibold">Email:</span> <span id="modalEmailPeminjam"></span></p>
      <p><span class="font-semibold">Luas Lahan:</span> <span id="modalLuasLahan"></span></p>
      <p><span class="font-semibold">Alamat:</span> <span id="modalAlamatPeminjam"></span></p>
    </div>

    <!-- Detail Alsintan -->
    <div class="space-y-2 mb-4">
      <p><span class="font-semibold">Nama Alsintan:</span> <span id="modalNamaAlsintan"></span></p>
      <p><span class="font-semibold">Tanggal Pinjam:</span> <span id="modalTanggalPinjam"></span></p>
      <p><span class="font-semibold">Tanggal Kembali:</span> <span id="modalTanggalKembali"></span></p>
      <p><span class="font-semibold">Keterangan:</span> <span id="modalKeterangan"></span></p>
    </div>

    <!-- Tombol -->
    <div class="flex justify-end gap-3">
      <button onclick="closeApprovalModal()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Tutup</button>
      <form id="approvalForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="approved">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Setujui</button>
      </form>
    </div>
  </div>
</div>
