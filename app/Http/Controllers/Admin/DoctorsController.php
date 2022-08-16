<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PatientToDoctor;
use App\User;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index()
    {
        $doctors = User::role('Doctor')->with('doctorProfile')->get();

        return view('admin.doctor.doctors-list', ['doctors' => $doctors]);
    }

    public function profile($id)
    {
        $user = User::findorfail($id);
        $profile = $user->doctorProfile()->first();
        $patients = PatientToDoctor::where('doctor_id', $user->id)->get();

        return view('admin.doctor.show-profile', ['profile' => $profile, 'user' => $user, 'patients' => $patients]);
    }

    public function status(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        $user = User::find($data['id']);

        $user->active = $data['status'];
        $user->save();
    }

    public function addPatient(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'patient_id' => 'required',
        ]);

        $data['patient_id'] = mb_substr($data['patient_id'], 1);
        $user = User::findorfail($data['patient_id']);
        if (!$user->hasRole('Patient')) abort(404);

        if ($user->patientToDoctor()->where('doctor_id', $data['id'])->get()->isEmpty()) {
            $user->patientToDoctor()->create(['doctor_id' => $data['id']]);
        }

        return redirect()->route('admin.doctor-profile', ['id' => $data['id']]);
    }

    public function delete(Request $request) {
      $data = $request->validate([
        'id' => 'required|numeric'
      ]);

      User::where('id', $data['id'])->delete();
      return back();
    }
}
