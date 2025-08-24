<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjukanSewaController extends Controller
{
  public function index()
  {
    return view('farmer.sewa_alsintan.ajukan_sewa.index');
  }
}
