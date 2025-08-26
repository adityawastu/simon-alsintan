<?php

namespace App\Models\admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeminjamanAlsintan extends Model
{
  use HasFactory;

  protected $table = 'peminjaman_alsintans';

  protected $fillable = ['data_alsintan_id', 'user_id', 'tanggal_pinjam', 'tanggal_kembali', 'status', 'keterangan'];

  public function alsintan()
  {
    return $this->belongsTo(DataAlsintan::class, 'data_alsintan_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function farmerProfile()
  {
    return $this->hasOneThrough(
      \App\Models\FarmerProfile::class, // Model tujuan
      \App\Models\User::class, // Model perantara
      'id', // Foreign key di tabel users
      'user_id', // Foreign key di tabel farmer_profiles
      'user_id', // Local key di tabel peminjaman
      'id', // Local key di tabel users
    );
  }
}
