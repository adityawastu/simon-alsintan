<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Farmer\FarmerProfile;

class FarmerProfileController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    $profile = $user->farmerProfile;

    return view('farmer.profile.show', compact('user', 'profile'));
  }

  public function create()
  {
    $user = Auth::user();

    // Jika sudah punya profile, arahkan ke edit
    if ($user->farmerProfile) {
      return redirect()->route('farmer.profile.edit')->with('status', 'Profil sudah ada. Silakan lakukan perubahan.');
    }

    return view('farmer.profile.create', compact('user'));
  }

  public function store(Request $request)
  {
    $user = Auth::user();

    // Kalau sudah punya, cegah duplikasi
    if ($user->farmerProfile) {
      return redirect()->route('farmer.profile.edit')->with('status', 'Profil sudah ada. Silakan lakukan perubahan.');
    }

    $data = $this->validatedData($request);
    $data['user_id'] = $user->id;

    FarmerProfile::create($data);

    return redirect()->route('farmer.profile.show')->with('status', 'Profil berhasil dibuat.');
  }

  public function edit()
  {
    $user = Auth::user();
    $profile = $user->farmerProfile;

    if (!$profile) {
      return redirect()
        ->route('farmer.profile.create')
        ->with('status', 'Belum ada profil. Silakan buat profil terlebih dahulu.');
    }

    return view('farmer.profile.edit', compact('user', 'profile'));
  }

  public function update(Request $request)
  {
    $user = Auth::user();
    $profile = $user->farmerProfile;

    // Jika belum ada, otomatis buat (opsional). Atau bisa redirect ke create.
    if (!$profile) {
      $data = $this->validatedData($request);
      $data['user_id'] = $user->id;
      FarmerProfile::create($data);

      return redirect()->route('farmer.profile.show')->with('status', 'Profil berhasil dibuat.');
    }

    $data = $this->validatedData($request);
    $profile->update($data);

    return redirect()->route('farmer.profile.show')->with('status', 'Profil berhasil diperbarui.');
  }

  private function validatedData(Request $request): array
  {
    return $request->validate([
      'no_ktp' => ['required', 'string', 'max:32'],
      'alamat' => ['required', 'string', 'max:255'],
      'desa' => ['required', 'string', 'max:100'],
      'kecamatan' => ['required', 'string', 'max:100'],
      'kabupaten' => ['required', 'string', 'max:100'],
      'provinsi' => ['required', 'string', 'max:100'],
      'luas_lahan' => ['nullable', 'numeric', 'min:0'],
      'kontak' => ['required', 'string', 'max:50'],
    ]);
  }
}
