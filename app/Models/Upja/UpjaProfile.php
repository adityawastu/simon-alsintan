<?php

namespace App\Models\Upja;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UpjaProfile extends Model
{
    protected $fillable = [
        'user_id',
        'nama_upja',
        'penanggung_jawab',
        'no_hp',
        'alamat',
        'kecamatan',
        'kabupaten',
        'npwp',
        'sk_pendirian'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
