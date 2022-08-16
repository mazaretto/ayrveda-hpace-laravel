<?php

namespace App\Http\Controllers\Doctor;

use App\DoctorProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
  public function index()
  {
    return view('doctor.doctor-dashboard');
  }

  public function settings()
  {
    return view('doctor.doctor-profile-settings');
  }

  public function social()
  {
    return view('doctor.social-media');
  }

  public function setSocial(Request $request)
  {
    $data = $request->validate([
      'facebook' => 'nullable|string',
      'twitter' => 'nullable|string',
      'instagram' => 'nullable|string',
      'pinterest' => 'nullable|string',
      'linkedin' => 'nullable|string',
      'youtube' => 'nullable|string',
    ]);

    $social = auth()->user()->social()->first();

    if ($social == null) {
      auth()->user()->social()->create($data);
    } else {
      auth()->user()->social()->update($data);
      auth()->user()->push();
    }

    return redirect()->route('doctor.social');
  }

  private function checkBlank($array) {
    $isOk = true;
    foreach ($array as $item) {
      if ($item == '') {
        $isOk = false;
        break;
      }
    }
    if ($isOk) {
      return $array;
    } else {
      return null;
    }
  }

  public function setProfile(Request $request)
  {
    $user = auth()->user();
    $data = $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'patronymic' => 'required',
      'photo' => 'nullable|file',
      'gender' => 'nullable|string',
      'birth' => 'nullable|string',
      'biography' => 'nullable|string',
      'clinic_address' => 'nullable|string',
      'clinic_name' => 'nullable|string',
      'clinic_pics' => 'nullable',
      'zip_code' => 'nullable|string',
      'country' => 'nullable|string',
      'state' => 'nullable|string',
      'city' => 'nullable|string',
      'address' => 'nullable|string',
      'price' => 'nullable|string',
      'services' => 'nullable|string',
      'specialist' => 'nullable|string',
      'education' => 'nullable',
      'experience' => 'nullable',
      'awards' => 'nullable',
      'membership' => 'nullable',
      'registrations' => 'nullable',
    ]);
    $profile = $user->doctorProfile()->first();
    if (isset($data['photo'])) {
      if (($profile->photo ?? null) !== null) {
        Storage::disk('public')->delete($profile->photo);
      }
      $data['photo'] = Storage::disk('public')->put('/doctor/profile', $data['photo']);
    } elseif ($profile !== null) {
      $data['photo'] = $profile->photo;
    }

    if (isset($data['clinic_pics'])) {
      if (($profile->clinic_pics ?? null) !== null) {
        foreach (explode(',', $profile->pics) as $pic) {
          Storage::disk('public')->delete($pic);
        }
      }

      $pics = [];
      foreach ($data['clinic_pics'] as $pic) {
        $path = Storage::disk('public')->put('/doctor/clinic-images', $pic);
        array_push($pics, $path);
      }
      $data['clinic_pics'] = implode(',', $pics);
    } elseif ($profile !== null) {
      $data['clinic_pics'] = $profile->clinic_pics;
    }

    if (isset($data['education'])) {
      $temp = [];
      foreach ($data['education'] as $item) {
        $ser = explode(';,-;', $item);
        if ($this->checkBlank($ser)) {
          array_push($temp, $ser);
        }
      }
      $data['education'] = serialize($temp);
    } else {
      $data['education'] = null;
    }


    if (isset($data['experience'])) {
      $temp = [];
      foreach ($data['experience'] as $item) {
        $ser = explode(';,-;', $item);
        if ($this->checkBlank($ser)) {
          array_push($temp, $ser);
        }
      }
      $data['experience'] = serialize($temp);
    } else {
      $data['experience'] = null;
    }

    if (isset($data['awards'])) {
      $temp = [];
      foreach ($data['awards'] as $item) {
        $ser = explode(';,-;', $item);
        if ($this->checkBlank($ser)) {
          array_push($temp, $ser);
        }
      }
      $data['awards'] = serialize($temp);
    } else {
      $data['awards'] = null;
    }

    if (isset($data['membership'])) {
      $temp = [];
      foreach ($data['membership'] as $item) {
        $ser = explode(';,-;', $item);
        if ($this->checkBlank($ser)) {
          array_push($temp, $ser);
        }
      }
      $data['membership'] = serialize($temp);
    } else {
      $data['membership'] = null;
    }

    if (isset($data['registrations'])) {
      $temp = [];
      foreach ($data['registrations'] as $item) {
        $ser = explode(';,-;', $item);
        if ($this->checkBlank($ser)) {
          array_push($temp, $ser);
        }
      }
      $data['registrations'] = serialize($temp);
    } else {
      $data['registrations'] = null;
    }

    if ($profile == null) {
      DoctorProfile::unguard(true);
      $user->doctorProfile()->create($data);
      DoctorProfile::unguard(false);
    } else {
      DoctorProfile::unguard(true);
      $user->doctorProfile()->update($data);
      $user->push();
      DoctorProfile::unguard(false);
    }
    return redirect()->route('doctor.settings');
  }
}
