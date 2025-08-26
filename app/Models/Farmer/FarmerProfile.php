<?php

namespace App\Models\Farmer;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FarmerProfile extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'no_ktp',
    'alamat',
    'desa',
    'kecamatan',
    'kabupaten',
    'provinsi',
    'luas_lahan',
    'jenis_tanaman',
    'kontak',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function farmerProfile()
  {
    return $this->hasOne(FarmerProfile::class);
  }
}
