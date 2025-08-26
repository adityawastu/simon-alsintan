<?php

use Illuminate\Support\Facades\Route;

//admin controller
//use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetaLokasiController;
use App\Http\Controllers\Admin\DataAlsintanController;
use App\Http\Controllers\Admin\DataUpjaController;
use App\Http\Controllers\Admin\ServiceHistoryController;
use App\Http\Controllers\Admin\MonitoringAlsintanController;
use App\Http\Controllers\Admin\PeminjamanAlsintanController;

//auth controller
use App\Http\Controllers\Auth\LoginController;

//upja controller
use App\Http\Controllers\Upja\DashboardController as UpjaDashboardController;

//farmer controller
use App\Http\Controllers\Farmer\BerandaController as FarmerBerandaController;
use App\Http\Controllers\Farmer\DataAlsintanController as FarmerDataAlsintanController;
// use App\Http\Controllers\Farmer\SewaAlsintanController;
use App\Http\Controllers\Farmer\AjukanSewaController;
use App\Http\Controllers\Farmer\StatusPengajuanController;
use App\Http\Controllers\Farmer\RiwayatPenyewaanController;

//auth
Route::get('/', function () {
  return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
  //admin login
  Route::prefix('admin')
    ->name('admin.')
    ->middleware('role:admin')
    ->group(function () {
      //profle
      Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
      //beranda
      Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
      //dashboard
      Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
      //peta-lokasi
      Route::get('/index-peta-lokasi', [PetaLokasiController::class, 'index'])->name('index.peta.lokasi');
      // Route::get('/peta-lokasi-alsintan', [PetaLokasiController::class, 'lokasiAlsintan'])->name('peta.lokasi.alsintan');
      Route::get('/monitoring/{sensor_id}', [PetaLokasiController::class, 'show'])->name('peta.lokasi.alsintan');
      //monitoring aktivitas
      Route::get('/monitoring-alsintan', [MonitoringAlsintanController::class, 'index'])->name('monitoring.aktivitas');

      // tambah sensor
      Route::post('/admin/alsintan/{alsintan}/sensor', [DataAlsintanController::class, 'attachSensor'])->name(
        'alsintan.sensor.attach',
      );
      Route::delete('/admin/alsintan/{alsintan}/sensor', [DataAlsintanController::class, 'detachSensor'])->name(
        'alsintan.sensor.detach',
      );
      // Data_alsintan
      Route::get('/data-alsintan', [DataAlsintanController::class, 'index'])->name('data.alsintan');
      Route::get('/tambah-alsintan', [DataAlsintanController::class, 'create'])->name('create.alsintan');
      Route::post('/alsintan/store', [DataAlsintanController::class, 'store'])->name('alsintan.store');
      Route::get('/alsintan/show/{id}', [DataAlsintanController::class, 'show'])->name('alsintan.show');
      Route::delete('/alsintan/{id}', [DataAlsintanController::class, 'destroy'])->name('alsintan.destroy');
      Route::get('/alsintan/{id}/edit', [DataAlsintanController::class, 'edit'])->name('alsintan.edit');
      Route::put('/alsintan/{id}', [DataAlsintanController::class, 'update'])->name('alsintan.update');

      // data Upja
      Route::get('/data-upja', [DataUpjaController::class, 'index'])->name('upja.index');

      //service history
      Route::get('/alsintan/{id}/service-history/create', [ServiceHistoryController::class, 'create'])->name(
        'service.create',
      );
      Route::post('/service-history/store', [ServiceHistoryController::class, 'store'])->name('service.store');
      Route::get('/service-history/{id}/edit', [ServiceHistoryController::class, 'edit'])->name('service.edit');
      Route::delete('/service-history/{id}', [ServiceHistoryController::class, 'destroy'])->name('service.destroy');

      //user
      // Route::get('/profile-user', [UserController::class, 'show'])->name('user.show');
      // Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
      // Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
      // Route::post('/user', [UserController::class, 'store'])->name('user.store');
      // Route::delete('/destroy-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

      //peminjaman alsitan
      // Route::get('/peminjaman-alsintan', [PeminjamanAlsintanController::class, 'index'])->name(
      //   'peminjaman.alsintan.index',
      // );
      // Route::get('/riwayat-peminjaman-alsintan', [PeminjamanAlsintanController::class, 'riwayat'])->name(
      //   'riwayat.peminjaman.alsintan',
      // );

      Route::get('/peminjaman', [PeminjamanAlsintanController::class, 'index'])->name('peminjaman.index');
      Route::get('/peminjaman/riwayat', [PeminjamanAlsintanController::class, 'riwayat'])->name('peminjaman.riwayat');
      Route::post('/peminjaman/store', [PeminjamanAlsintanController::class, 'store'])->name('peminjaman.store');
      Route::put('/peminjaman/{id}/status', [PeminjamanAlsintanController::class, 'updateStatus'])->name(
        'peminjaman.updateStatus',
      );
    });

  //upja login
  Route::prefix('upja')
    ->name('upja.')
    ->middleware('role:upja')
    ->group(function () {
      Route::get('/dashboard', [UpjaDashboardController::class, 'index'])->name('dashboard');
    });

  //famrmer login
  Route::prefix('farmer')
    ->name('farmer.')
    ->middleware('role:farmer')
    ->group(function () {
      Route::get('/beranda', [FarmerBerandaController::class, 'index'])->name('beranda');
      // Route::get('/ajukan-sewa-alsintan', [SewaAlsintanController::class, 'index'])->name('sewaalsintan.index');

      //data alsintan
      Route::get('/data-alsintan', [FarmerDataAlsintanController::class, 'index'])->name('dataalsintan.index');
      //ajukan sewa
      Route::get('/ajukan-sewa', [AjukanSewaController::class, 'index'])->name('ajukansewa.index');
      //status pengajuan
      Route::get('/status-pengajuan', [StatusPengajuanController::class, 'index'])->name('statuspengajuan.index');
      //riwayat penyewaan
      Route::get('/riwayat-penyewaan', [RiwayatPenyewaanController::class, 'index'])->name('riwayatpenyewaan.index');
    });
});
