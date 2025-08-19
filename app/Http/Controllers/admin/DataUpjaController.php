<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataUpjaController extends Controller
{
    public function index()
    {
        return view('admin.upja_management.index');
    }
    public function hibah()
    {
        return view('admin.upja_management.index');
    }
}
