<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $profile = $user->hasRole('Doctor') ? $user->doctorProfile()->first() : ($user->hasRole('Patient') ? $user->patientProfile()->first() : null);

        return view('admin.show-profile', ['user' => $user, 'profile' => $profile]);
    }
}
