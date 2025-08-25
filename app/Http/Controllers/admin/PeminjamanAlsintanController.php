<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamanAlsintanController extends Controller
{
  public function index()
  {
    return view('admin.peminjaman_alsintan.index');
  }
  public function riwayat()
  {
    return view('admin.peminjaman_alsintan.riwayat_peminjaman');
  }
}
