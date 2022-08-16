<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SellerController extends Controller
{
  public function set(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|numeric',
      'seller' => 'nullable',
    ]);

    $user = User::find($data['id']);

    if (!$user) return back();

    if (isset($data['seller'])) $user->assignRole(Role::findOrCreate('Seller'));
    else $user->removeRole(Role::findOrCreate('Seller'));

    return back();
  }
}
