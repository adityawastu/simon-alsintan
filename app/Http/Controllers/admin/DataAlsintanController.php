<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Merk;
use App\Models\Admin\Category;
use App\Models\Admin\SensorData;
use App\Models\Admin\DataAlsintan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DataAlsintanController extends Controller
{
  public function index()
  {
    // Ambil data alsintan dengan relasi kategori dan merk, pakai pagination
    $alsintansPaginated = DataAlsintan::with(['category', 'merk'])->paginate(10);

    // Transformasi data di dalam paginasi, tambahkan status dan waktu terakhir data sensor
    $alsintansPaginated->getCollection()->transform(function ($item) {
      $latestSensor = \App\Models\Admin\SensorData::where('sensor_id', $item->sensor_id)
        ->latest()
        ->first();

      $item->status = ($latestSensor && $latestSensor->created_at > now()->subMinutes(5)) ? 'ON' : 'OFF';
      $item->lastTime = $latestSensor?->created_at;

      return $item;
    });

    return view('admin.asset_management.data_alsintan.index_alsintan', [
      'alsintans' => $alsintansPaginated
    ]);
  }

  public function create()
  {
    $categories = Category::all();
    $merks = Merk::all();
    $sensors = SensorData::select('*')
      ->whereIn('id', function ($query) {
        $query->selectRaw('MAX(id)')
          ->from('sensor_data')
          ->groupBy('sensor_id');
      })->get();


    return view('admin.asset_management.data_alsintan.create_alsintan', compact('categories', 'merks', 'sensors'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name'        => 'required|string|max:255',
      'sensor_id'   => 'nullable|string|exists:sensor_data,sensor_id',
      'category_id' => 'nullable|integer|exists:categories,id',
      'merk_id'     => 'nullable|integer|exists:merks,id',
      'description' => 'nullable|string',
      'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('alsintan_images', 'public');
    }

    DataAlsintan::create([
      'name'        => $validated['name'],
      'sensor_id'   => $validated['sensor_id'] ?? null,
      'category_id' => $validated['category_id'] ?? null,
      'merk_id'     => $validated['merk_id'] ?? null,
      'description' => $validated['description'] ?? null,
      'image'       => $imagePath,
    ]);

    return redirect()->route('index_alsintan')->with('success', 'Data berhasil ditambahkan!');
  }

  public function show($id)
  {
    $alsintan = DataAlsintan::with(['category', 'merk', 'serviceHistories'])->findOrFail($id);

    // Ambil data sensor terbaru berdasarkan sensor_id
    $sensor_id = $alsintan->sensor_id;

    $latestData = SensorData::where('sensor_id', $sensor_id)->latest()->first();
    $dataSensor = SensorData::where('sensor_id', $sensor_id)->orderByDesc('created_at')->limit(5)->get();

    // Data GPS untuk tabel
    $gpsData = $dataSensor->map(function ($item) {
      return [
        'time' => $item->created_at->format('Y-m-d H:i:s'),
        'latitude' => $item->lat,
        'longitude' => $item->lng,
        'speed' => $item->speed,
      ];
    });

    // Data Sensor INA219 untuk tabel dan grafik
    $sensorData = $dataSensor->map(function ($item) {
      return [
        'time' => $item->created_at->format('Y-m-d H:i:s'),
        'bus' => $item->busvoltage,
        'shunt' => $item->shuntvoltage,
        'load' => $item->loadvoltage,
      ];
    });

    // Untuk Chart.js
    $labels = $sensorData->pluck('time');
    $busVoltages = $sensorData->pluck('bus');
    $loadVoltages = $sensorData->pluck('load');

    return view('admin.asset_management.data_alsintan.show_alsintan', compact(
      'alsintan',
      'latestData',
      'gpsData',
      'sensorData',
      'labels',
      'busVoltages',
      'loadVoltages'
    ));
  }

  public function destroy($id)
  {
    $alsintan = DataAlsintan::findOrFail($id);
    $alsintan->delete();

    return redirect()->route('index_alsintan')->with('success', 'Data berhasil dihapus.');
  }

  public function edit($id)
  {
    $alsintan = DataAlsintan::findOrFail($id);
    $categories = Category::all();
    $merks = Merk::all();

    $sensors = SensorData::select('sensor_id')->distinct()->get();


    return view('admin.asset_management.data_alsintan.edit_alsintan', compact('alsintan', 'categories', 'merks', 'sensors'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'sensor_id' => 'required|string|exists:sensor_data,sensor_id',
      'category_id' => 'nullable|exists:categories,id',
      'merk_id' => 'nullable|exists:merks,id',

      'description' => 'nullable|string',
      'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $alsintan = DataAlsintan::findOrFail($id);

    $alsintan->name = $request->name;
    $alsintan->sensor_id = $request->sensor_id;
    $alsintan->category_id = $request->category_id;
    $alsintan->merk_id = $request->merk_id;
    $alsintan->description = $request->description;

    // Jika ada upload gambar baru
    if ($request->hasFile('image')) {
      // Hapus gambar lama jika ada
      if ($alsintan->image) {
        Storage::delete('public/' . $alsintan->image);
      }

      // Simpan gambar baru
      $path = $request->file('image')->store('alsintan_images', 'public');
      $alsintan->image = $path;
    }
    $alsintan->save();

    return redirect()->route('admin.alsintan.show', $alsintan->id)->with('success', 'Data alsintan berhasil diperbarui.');
  }
}
