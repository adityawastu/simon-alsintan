<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    protected $fillable = ['user_id', 'nip', 'jabatan', 'unit_kerja', 'wilayah_kerja'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
