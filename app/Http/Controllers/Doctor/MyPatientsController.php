<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\MedicalRecord;
use App\PatientToDoctor;
use App\Prescription;
use App\Prescriptions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class MyPatientsController extends Controller
{
  public function index()
  {
    if (auth()->user()->hasRole('Admin') or auth()->user()->hasRole('Doctor-Main')) {
      $patients = User::role('Patient')->get();
    } else {
      $patients = PatientToDoctor::where('doctor_id', auth()->user()->id)->get();
    }

    return view('doctor.my-patients', ['patients' => $patients]);
  }

  public function setPrescription(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|numeric',
      'medicine_id' => 'required|numeric',
      'date' => 'required|date',
      'name' => 'required|string',
      'file' => 'file',
    ]);


    $user = User::findorfail($data['id']);

    unset($data['id']);
    $data['from_id'] = auth()->user()->id;
    $data['date'] = date('Y-m-d H:i:s', strtotime($data['date']));
    if(isset($data['file'])) {
      $data['file'] = Storage::disk('public')->put('prescriptions', $data['file']);
    }

    $user->prescription()->create($data);

    return redirect()->route('doctor.my-patient', ['id' => $user->id]);
  }

  public function setMedicalRecord(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|numeric',
      'date' => 'required|date',
      'description' => 'required|string',
      'file' => 'file|nullable',
    ]);

    $user = User::findorfail($data['id']);

    unset($data['id']);
    $data['from_id'] = auth()->user()->id;
    $data['date'] = date('Y-m-d H:i:s', strtotime($data['date']));
    if (isset($data['file'])) {
      $data['file_name'] = $data['file']->getClientOriginalName();
      $data['file'] = Storage::disk('public')->put('medical_records', $data['file']);
    }

    $user->medicalRecord()->create($data);

    return redirect()->route('doctor.my-patient', ['id' => $user->id]);
  }

  public function show($id)
  {
    $patient = User::findorfail($id);
    return view('doctor.patient-profile', ['user' => $patient]);
  }

  public function add(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|numeric'
    ]);
    $row = PatientToDoctor::where([
      ['user_id', $data['id']],
      ['doctor_id', auth()->user()->id],
    ])->first();

    if (!$row) {
      $patient = User::find($data['id']);
      if ($patient) {
        $patient->patientToDoctor()->create([
          'doctor_id' => auth()->user()->id
        ]);
      }
    }

    return redirect()->route('doctor.my-patients');
  }
}
