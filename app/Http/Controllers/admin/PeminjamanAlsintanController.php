<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\PeminjamanAlsintan;

class PeminjamanAlsintanController extends Controller
{
  public function index()
  {
    $peminjaman = PeminjamanAlsintan::with(['alsintan', 'user'])
      ->orderByRaw("FIELD(status, 'pending', 'approved', 'borrowed', 'returned', 'rejected') ASC")
      ->latest()
      ->get();

    return view('admin.peminjaman_alsintan.index', compact('peminjaman'));
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
