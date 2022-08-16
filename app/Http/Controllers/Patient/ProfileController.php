<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\AbstractList;

class ProfileController extends Controller
{
    public function index(){
        return view('patient.patient-dashboard', ['user' => auth()->user()]);
    }

    public function settings(){
        $user = auth()->user()->patientProfile()->first();
        return view('patient.profile-settings', ['user' => $user]);
    }

    public function setProfile(Request $request){
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'patronymic' => 'required|string',
            'photo' => 'nullable|file',
            'birth' => 'nullable|date',
            'blood_group' => 'nullable|string',
            'gender' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $profile = auth()->user()->patientProfile()->first();

        if (isset($data['photo'])){
            $data['photo'] = Storage::disk('public')->put('/patient/profile', $data['photo']);
        } elseif ($profile !== null) {
            $data['photo'] = auth()->user()->patientProfile()->first()->photo;
        }

        if ($profile == null) {
            auth()->user()->patientProfile()->create($data);
        } else {
            auth()->user()->patientProfile()->update($data);
            auth()->user()->push();
        }

        return redirect()->route('patient.settings');
    }
}
