<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DoctorProfiles extends Controller
{
  public function index()
  {
    $doctors = User::where('active', true)->role('Doctor')->get();

    return view('doctors-list', ['doctors' => $doctors]);
  }

  public function search()
  {
    if (request()->s == null) {
      $doctors = User::where('active', true)->role('Doctor')->get();
      return view('doctors-find', ['doctors' => $doctors, 'search' => '']);
    }
    $data = request()->validate([
      's' => 'required'
    ]);
    $s = $data['s'];
    $doctor_list = [];

    $doctors = User::role('Doctor')->get();
    foreach ($doctors as $doctor) {
      if (in_array($doctor, $doctor_list)) {
        continue;
      }

      if ($this->checkCont($doctor->name, $s)) {
        array_push($doctor_list, $doctor);
        continue;
      }
      $profile = $doctor->doctorProfile()->first();

      $full_name = ($profile->first_name ?? null) . ' ' . ($profile->last_name ?? null) . ' ' . ($profile->patronymic ?? null);
      if ($this->checkCont($full_name, $s)) {
        array_push($doctor_list, $doctor);
        continue;
      }

      $serv_spec = [];
      $serv_spec_s = array_merge(explode(',', $profile->services ?? ''), explode(',', $profile->specialist ?? ''));
      foreach ($serv_spec_s as $item) {
        $serv_spec[] = $item;
      }

      if ($this->checkCont(implode(' ', $serv_spec), $s)) {
        array_push($doctor_list, $doctor);
        continue;
      }
    }

    return view('doctors-find', ['doctors' => $doctor_list, 'search' => $s]);
  }

  private function checkCont($main, $search)
  {
    return stripos($main, $search) !== false;
  }

  public function show($id)
  {
    $user = User::findorfail($id);

    if (!$user->hasRole('Doctor')) abort(404);

    return view('doctor-profile', ['user' => $user]);
  }
}
