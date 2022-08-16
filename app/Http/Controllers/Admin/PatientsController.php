<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index()
    {
        $patients = User::role('Patient')->with('patientProfile')->get();

        return view('admin.patient.patients-list', ['patients' => $patients]);
    }

    public function profile($id)
    {
        $user = User::findorfail($id);
        $profile = $user->patientProfile()->first();

        return view('admin.patient.show-profile', ['user' => $user, 'profile' => $profile]);
    }

    public function delete(Request $request) {
      $data = $request->validate([
        'id' => 'required|numeric'
      ]);

      User::where('id', $data['id'])->delete();

      return back();
    }
}
