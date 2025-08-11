<?php

namespace App\Models\Farmer;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FarmerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'no_hp',
        'alamat',
        'luas_lahan',
        'komoditas_utama',
        'kelompok_tani'
    ];
    protected $casts = [
        'luas_lahan' => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
