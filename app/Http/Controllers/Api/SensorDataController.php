<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\SensorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SensorDataController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sensor_id'     => 'required|string',
            'lat'           => 'required|numeric',
            'lng'           => 'required|numeric',
            'speed'         => 'required|numeric',
            'loadvoltage'   => 'required|numeric',
            'busvoltage'    => 'required|numeric',
            'shuntvoltage'  => 'required|numeric',
        ]);

        Log::info('Data diterima dari SIM800L:', $validated);
        Log::info('Request masuk:', $request->all());

        SensorData::create($validated);

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $validated
        ], 201);
    }

    public function checkStatus($sensor_id)
    {
        $latestData = SensorData::where('sensor_id', $sensor_id)
            ->latest()
            ->first();

        if (!$latestData) {
            return response()->json([
                'sensor_id' => $sensor_id,
                'status' => 'OFF',
                'message' => 'Belum ada data masuk dari sensor ini.'
            ]);
        }

        $isAlive = $latestData->created_at->gt(now()->subMinutes(5));

        return response()->json([
            'sensor_id' => $sensor_id,
            'status' => $isAlive ? 'ON' : 'OFF',
            'last_data_time' => $latestData->created_at->toDateTimeString()
        ]);
    }
}
