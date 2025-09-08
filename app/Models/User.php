<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Upja\UpjaProfile;
use App\Models\Admin\AdminProfile;
use App\Models\Farmer\FarmerProfile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $fillable = ['name', 'email', 'password', 'role'];
  protected $hidden = ['password', 'remember_token'];

  public function adminProfile()
  {
    return $this->hasOne(AdminProfile::class);
  }
  public function upjaProfile()
  {
    return $this->hasOne(UpjaProfile::class);
  }
  public function isAdmin(): bool
  {
    return $this->role === 'admin';
  }
  public function isUpja(): bool
  {
    return $this->role === 'upja';
  }
  public function isFarmer(): bool
  {
    return $this->role === 'farmer';
  }

  public function farmerProfile()
  {
    return $this->hasOne(FarmerProfile::class);
  }
}
