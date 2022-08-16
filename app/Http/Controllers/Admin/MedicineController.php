<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MedicineList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
  public function index()
  {
    $medicines = MedicineList::all();

    return view('admin.medicine.medicine-list', ['medicines' => $medicines]);
  }

  public function edit($id)
  {
    $medicine = MedicineList::findorfail($id);

    return view('admin.medicine.medicine-edit', ['medicine' => $medicine]);
  }

  public function imageUpload($id, Request $request)
  {
    $data = $request->validate([
      'file' => 'required|file|image',
    ]);

    $medicine = MedicineList::findorfail($id);

    $file = Storage::disk('public')->put('/medicine/' . $medicine->id, $data['file']);
    $file_list = explode(',', $medicine->gallery);
    array_push($file_list, $file);

    $medicine->gallery = implode(',', $file_list);
    $medicine->save();
  }

  public function imageDelete($id, Request $request)
  {
    $data = $request->validate([
      'file' => 'required|string'
    ]);

    $medicine = MedicineList::find($id);

    $images_list = explode(',', $medicine->gallery);
    $data['file'] = str_replace('/storage/', '', $data['file']);
    foreach ($images_list as $key => $value) {
      if ($value == $data['file']) {
        Storage::disk('public')->delete($value);
        unset($images_list[$key]);
      } elseif ($value == '') {
        unset($images_list[$key]);
      }
    }

    $medicine->gallery = implode(',', $images_list);
    $medicine->save();
  }

  public function editSubmit(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|numeric',
      'name' => 'required|string',
      'price' => 'required|numeric',
      'image' => 'file|nullable',
      'description' => 'string',
      'sostav' => 'array',
      'doz' => 'array',
      'protiv' => 'array',
      'manufacter' => 'string|nullable',
      'manufacter_address' => 'string|nullable',
      'manufacter_phone' => 'string|nullable',
      'diseases' => 'array',
    ]);

    $medicine = MedicineList::findorfail($data['id']);

    unset($data['id']);

    $data['sostav'] = implode('\,/', array_filter($data['sostav']));
    $data['doz'] = implode('\,/', array_filter($data['doz']));
    $data['protiv'] = implode('\,/', array_filter($data['protiv']));
    $data['diseases'] = implode('\,/', array_filter($data['diseases']));

    if (isset($data['image'])) {
      $data['image'] = Storage::disk('public')->put('/medicine', $data['image']);
    }

    $medicine->update($data);
    return redirect()->route('admin.medicine-edit', ['id' => $medicine->id]);
  }

  public function add(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string',
      'price' => 'required|numeric',
      'image' => 'required|file',
      'description' => 'required|string',
    ]);

    $data['image'] = Storage::disk('public')->put('medicine', $data['image']);

    $medicine = MedicineList::create($data);
    return redirect()->route('admin.medicine-edit', ['id' => $medicine->id]);
  }

  public function delete(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|numeric'
    ]);

    MedicineList::destroy($data['id']);

    return redirect()->route('admin.medicine-list');
  }
}
