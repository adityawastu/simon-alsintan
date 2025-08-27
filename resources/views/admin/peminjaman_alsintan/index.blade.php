<x-layout>
  <div class="bg-white dark:bg-gray-800 relative p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-green-700 dark:text-gray-200">
        Data Peminjaman Alsintan
      </h1>
    </div>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('admin.peminjaman.index') }}" class="mb-6">
      <div class="flex flex-wrap gap-4 items-center">
        <!-- Filter Status -->
        <select name="status"
          class="w-56 px-4 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
          <option value="">Semua Status</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
          <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
          <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
        </select>

        <!-- Filter Kategori Alsintan -->
        <select name="category_id"
          class="w-56 px-4 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
          <option value="">Semua Kategori</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>

        <!-- Tombol Filter -->
        <button type="submit"
          class="px-5 py-2 bg-green-600 text-white text-sm rounded-lg shadow hover:bg-green-700 transition duration-200">
          Terapkan Filter
        </button>

        <!-- Tombol Reset -->
        <a href="{{ route('admin.peminjaman.index') }}"
          class="px-5 py-2 bg-gray-400 text-white text-sm rounded-lg shadow hover:bg-gray-500 transition duration-200">
          Reset
        </a>
      </div>
    </form>

    <!-- Alert -->
    @if (session('success'))
      <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg border border-green-300 shadow-sm" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg shadow">
      <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
        <thead class="text-xs text-gray-700 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-200">
          <tr>
            <th class="px-6 py-3">No</th>
            <th class="px-6 py-3">Nama Peminjam</th>
            <th class="px-6 py-3">Alsintan</th>
            <th class="px-6 py-3">Tanggal Pinjam</th>
            <th class="px-6 py-3">Tanggal Kembali</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($peminjaman as $item)
            <tr class="hover:bg-green-50 dark:hover:bg-gray-700 transition duration-150">
              <td class="px-6 py-3">{{ $loop->iteration }}</td>
              <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $item->user->name }}
              </td>
              <td class="px-6 py-3">{{ $item->alsintan->name }}</td>
              <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
              <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</td>
              <td class="px-6 py-3">
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
                  class="px-4 py-1.5 text-sm font-semibold rounded-md shadow-sm {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-700' }}">
                  {{ ucfirst($item->status) }}
                </span>
              </td>
              <td class="px-6 py-3 text-center space-x-2">
                @if ($item->status === 'pending')
                  <button type="button" onclick="showApprovalModal({{ $item }})"
                    class="px-4 py-1.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow">
                    Approve
                  </button>
                @elseif ($item->status === 'approved')
                  <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="borrowed">
                    <button type="submit"
                      class="px-4 py-1.5 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 shadow">
                      Tandai Dipinjam
                    </button>
                  </form>
                @elseif ($item->status === 'borrowed')
                  <form action="{{ route('admin.peminjaman.updateStatus', $item->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="returned">
                    <button type="submit"
                      class="px-4 py-1.5 text-sm font-semibold text-white bg-gray-600 rounded-lg hover:bg-gray-700 shadow">
                      Tandai Dikembalikan
                    </button>
                  </form>
                @else
                  <span class="text-gray-400 text-xs italic">Tidak ada aksi</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-6 text-gray-500">Tidak ada data peminjaman</td>
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
    document.getElementById("modalNamaPeminjam").innerText = item.user.name;
    document.getElementById("modalEmailPeminjam").innerText = item.user.email ?? '-';
    document.getElementById("modalLuasLahan").innerText = item.user.luas_lahan ?? 'Tidak diisi';
    document.getElementById("modalAlamatPeminjam").innerText = item.user.alamat ?? '-';
    document.getElementById("modalNamaAlsintan").innerText = item.alsintan.name;
    document.getElementById("modalTanggalPinjam").innerText = item.tanggal_pinjam;
    document.getElementById("modalTanggalKembali").innerText = item.tanggal_kembali;
    document.getElementById("modalKeterangan").innerText = item.keterangan ?? '-';

    document.getElementById("approvalForm").action = `/admin/peminjaman/${item.id}/status`;
    document.getElementById("rejectForm").action = `/admin/peminjaman/${item.id}/status`;

    document.getElementById("peminjamanApprovalModal").classList.remove("hidden");
  }

  function closeApprovalModal() {
    document.getElementById("peminjamanApprovalModal").classList.add("hidden");
  }
</script>
