<?php

use Illuminate\Support\Facades\Route;

//admin controller
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BerandaController as AdminBerandaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PetaLokasiController;
use App\Http\Controllers\Admin\DataAlsintanController;
use App\Http\Controllers\Admin\ServiceHistoryController;
use App\Http\Controllers\Admin\MonitoringAlsintanController;

//auth controller 
use App\Http\Controllers\Auth\LoginController;

//upja controller
use App\Http\Controllers\Upja\DashboardController as UpjaDashboardController;

//farmer controller
use App\Http\Controllers\Farmer\DashboardController as FarmerDashboardController;

//auth
Route::get('/', function () {
  return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
  //admin login
  Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    //beranda
    Route::get('/beranda', [AdminBerandaController::class, 'index'])->name('beranda');
    //dashboard 
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    //peta-lokasi
    Route::get('/index-peta-lokasi', [PetaLokasiController::class, 'index'])->name('index.peta.lokasi');
    // Route::get('/peta-lokasi-alsintan', [PetaLokasiController::class, 'lokasiAlsintan'])->name('peta.lokasi.alsintan');
    Route::get('/monitoring/{sensor_id}', [PetaLokasiController::class, 'show'])->name('peta.lokasi.alsintan');
    //monitoring aktivitas
    Route::get('/monitoring-alsintan', [MonitoringAlsintanController::class, 'index'])->name('monitoring.aktivitas');
    // Data_alsintan
    Route::get('/data-alsintan', [DataAlsintanController::class, 'index'])->name('index_alsintan');
    Route::get('/create-alsintan', [DataAlsintanController::class, 'create'])->name('create_alsintan');
    Route::post('/alsintan/store', [DataAlsintanController::class, 'store'])->name('dataalsintan.store');
    Route::get('/alsintan/show/{id}', [DataAlsintanController::class, 'show'])->name('alsintan.show');
    Route::delete('/alsintan/{id}', [DataAlsintanController::class, 'destroy'])->name('alsintan.destroy');
    Route::get('/alsintan/{id}/edit', [DataAlsintanController::class, 'edit'])->name('alsintan.edit');
    Route::put('/alsintan/{id}', [DataAlsintanController::class, 'update'])->name('alsintan.update');
    //service history 
    Route::get('/alsintan/{id}/service-history/create', [ServiceHistoryController::class, 'create'])->name('service.create');
    Route::post('/service-history/store', [ServiceHistoryController::class, 'store'])->name('service.store');
    Route::get('/service-history/{id}/edit', [ServiceHistoryController::class, 'edit'])->name('service.edit');
    Route::delete('/service-history/{id}', [ServiceHistoryController::class, 'destroy'])->name('service.destroy');
    //user
    // Route::get('/profile-user', [UserController::class, 'show'])->name('user.show');
    // Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
    // Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    // Route::post('/user', [UserController::class, 'store'])->name('user.store');
    // Route::delete('/destroy-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
  });

  //upja login
  Route::prefix('upja')->name('upja.')->middleware('role:upja')->group(function () {
    Route::get('/dashboard', [UpjaDashboardController::class, 'index'])->name('dashboard');
  });

  //famrmer login

  Route::prefix('farmer')->name('farmer.')->middleware('role:farmer')->group(function () {
    Route::get('/dashboard', [FarmerDashboardController::class, 'index'])->name('dashboard');
  });
});
