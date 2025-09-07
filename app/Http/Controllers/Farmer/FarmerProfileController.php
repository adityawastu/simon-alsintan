<?php

namespace App\Http\Controllers\Farmer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmer\FarmerProfile;

class FarmerProfileController extends Controller
{
  public function create()
  {
    $user = auth()->user();
    return view('farmer.profile', compact('user'));
  }
}
