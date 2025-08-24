<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataAlsintanController extends Controller
{
  public function index()
  {
    return view('farmer.data_alsintan.index');
  }
}
