<?php

namespace App\Http\Controllers\Patient;

use App\Diseases;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiseasesController extends Controller
{
  public function index()
  {
    $diseases = json_decode(Diseases::first()->data ?? '');

    return view('patient.patient-diseases', ['diseases' => $diseases]);
  }

  public function set(Request $request)
  {
    $data = $request->validate([
      'data' => 'required'
    ]);

    $data['data'] = implode(',', $data['data']);
    auth()->user()->patientDiseases()->delete();
    auth()->user()->patientDiseases()->create($data);

    return redirect()->route('patient.diseases');
  }

  public static function getLocalName($name)
  {
    $loc = app()->getLocale();
    $name = explode('||', $name);

    if ($loc == 'ru') {
      return $name[0];
    } elseif ($loc == 'en' and isset($name[1])) {
      return $name[1];
    } else {
      return $name[0];
    }
  }
}
