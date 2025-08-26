<!-- resources/views/admin/peminjaman/index.blade.php -->
<x-layout>
  <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden p-2">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
      <div class="w-full flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-green-700 dark:text-gray-200">
          Data Peminjaman Alsintan
        </h1>
      </div>
    </div>

    <!-- Alert -->
    @if (session('success'))
      <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Nama Peminjam</th>
            <th class="px-4 py-2">Alsintan</th>
            <th class="px-4 py-2">Tanggal Pinjam</th>
            <th class="px-4 py-2">Tanggal Kembali</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($peminjaman as $item)
            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
              <td class="px-4 py-2">{{ $loop->iteration }}</td>
              <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->user->name }}</td>
              <td class="px-4 py-2">{{ $item->alsintan->name }}</td>
              <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
              <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
              <td class="px-4 py-2">
                @php
                  $statusColors = [
                      'pending' => 'bg-yellow-100 text-yellow-700',
                      'approved' => 'bg-blue-100 text-blue-700',
                      'borrowed' => 'bg-green-100 text-green-700',
                      'returned' => 'bg-gray-100 text-gray-700',
                      'rejected' => 'bg-red-100 text-red-700',
                      'overdue' => 'bg-orange-100 text-orange-700',
                  ];
                @endphp
                <span
                  class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-700' }}">
                  {{ ucfirst($item->status) }}
                </span>
              </td>
              <td class="px-4 py-2 text-center">
                @if ($item->status === 'pending')
                  <!-- Tombol Approve buka modal -->
                  <button type="button" onclick="showApprovalModal({{ $item }})"
                    class="px-3 py-1 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                    Approve
                  </button>
                @elseif ($item->status === 'approved')
                  <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="flex justify-center">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="borrowed">
                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                      Tandai Dipinjam
                    </button>
                  </form>
                @elseif ($item->status === 'borrowed')
                  <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="flex justify-center">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="returned">
                    <button type="submit" class="px-3 py-1 text-sm font-semibold text-white bg-gray-600 rounded hover:bg-gray-700">
                      Tandai Dikembalikan
                    </button>
                  </form>
                @else
                  <span class="text-gray-500 text-xs">Tidak ada aksi</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-5 text-gray-500">Tidak ada data peminjaman</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Include Modal -->
  <x-modal.peminjaman-approval-modal />
</x-layout>
<script>
  function showApprovalModal(item) {
    // Set data ke modal
    document.getElementById("modalNamaPeminjam").innerText = item.user.name;
    document.getElementById("modalEmailPeminjam").innerText = item.user.email ?? '-';
    document.getElementById("modalLuasLahan").innerText = item.user.luas_lahan ?? 'Tidak diisi';
    document.getElementById("modalAlamatPeminjam").innerText = item.user.alamat ?? '-';
    document.getElementById("modalNamaAlsintan").innerText = item.alsintan.name;
    document.getElementById("modalTanggalPinjam").innerText = item.tanggal_pinjam;
    document.getElementById("modalTanggalKembali").innerText = item.tanggal_kembali;
    document.getElementById("modalKeterangan").innerText = item.keterangan ?? '-';

    // Update form action untuk approve
    document.getElementById("approvalForm").action = `/admin/peminjaman/${item.id}/status`;

    // Tampilkan modal
    document.getElementById("peminjamanApprovalModal").classList.remove("hidden");
  }

  function closeApprovalModal() {
    document.getElementById("peminjamanApprovalModal").classList.add("hidden");
  }
</script>
