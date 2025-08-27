<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\DataAlsintan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\PeminjamanAlsintan;

class PeminjamanAlsintanController extends Controller
{
  public function index(Request $request)
  {
    $status = $request->get('status');
    $category_id = $request->get('category_id');

    // Ambil semua kategori untuk dropdown filter
    $categories = Category::orderBy('name', 'asc')->get();

    // Query peminjaman dengan relasi alsintan, kategori, dan user
    $query = PeminjamanAlsintan::with(['alsintan.category', 'user'])
      ->orderByRaw("FIELD(status, 'pending', 'approved', 'borrowed', 'returned', 'rejected') ASC")
      ->latest();

    // Filter berdasarkan status jika dipilih
    if (!empty($status)) {
      $query->where('status', $status);
    }

    // Filter berdasarkan kategori alsintan jika dipilih
    if (!empty($category_id)) {
      $query->whereHas('alsintan', function ($q) use ($category_id) {
        $q->where('category_id', $category_id);
      });
    }

    $peminjaman = $query->get();

    return view('admin.peminjaman_alsintan.index', compact('peminjaman', 'categories', 'status', 'category_id'));
  }

  public function riwayat()
  {
    $riwayat = PeminjamanAlsintan::with(['user', 'alsintan'])
      ->whereIn('status', ['returned', 'rejected', 'overdue'])
      ->orderBy('updated_at', 'desc')
      ->paginate(10);

    return view('admin.peminjaman_alsintan.riwayat', compact('riwayat'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'data_alsintan_id' => 'required|exists:data_alsintans,id',
      'tanggal_pinjam' => 'required|date',
      'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ]);

    PeminjamanAlsintan::create([
      'data_alsintan_id' => $request->data_alsintan_id,
      'user_id' => Auth::id(),
      'tanggal_pinjam' => $request->tanggal_pinjam,
      'tanggal_kembali' => $request->tanggal_kembali,
      'status' => 'pending',
    ]);

    return back()->with('success', 'Pengajuan peminjaman berhasil dikirim.');
  }

  public function updateStatus(Request $request, $id)
  {
    $peminjaman = PeminjamanAlsintan::findOrFail($id);

    $request->validate([
      'status' => 'required|in:approved,rejected,borrowed,returned',
    ]);

    $peminjaman->status = $request->status;
    $peminjaman->save();

    return back()->with('success', 'Status peminjaman berhasil diperbarui.');
  }
}
