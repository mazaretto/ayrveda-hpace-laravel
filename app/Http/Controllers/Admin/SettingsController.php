<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SiteSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
  public function index()
  {
    $settings_list = SiteSettings::select(['key', 'value'])->get();
    $settings = [];
    foreach ($settings_list as $item) {
      $settings[$item->key] = $item->value;
    }

    return view('admin.settings', ['settings' => $settings]);
  }

  public function set(Request $request)
  {
    foreach ($request->all() as $key => $value) {
      $row = SiteSettings::firstOrCreate(['key' => $key]);

      $row->value = $value;
      $row->save();
    }

    return redirect()->route('admin.settings');
  }
}
