<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use Notifiable;
  use HasRoles;

  /*
   * Roles list:
   *
   * Patient
   * Doctor
   * Doctor-Main
   * Admin
   */

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'phone', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  static public function userNameFormat($user){
    if($user == null) {
      $user = auth()->user();
    }
    $isDoctor = false;
    if ($user->hasRole('Patient')) {
      $profile = $user->patientProfile()->first();
    } elseif ($user->hasRole('Doctor')) {
      $isDoctor = true;
      $profile = $user->doctorProfile()->first();
    } else {
      return $user->name ?? 'Not Found';
    }

    $name = $user->name ?? 'Not Found';

    if (($profile->first_name ?? null) and ($profile->last_name ?? null)) {
      if ($user->hasRole('Doctor')) {
        $dr_pre = trans('regular.dr_pre');
      } else {
        $dr_pre = null;
      }
      if ($profile->patronymic??null) {
        $name =  $dr_pre . $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
      } else {
        $name = $dr_pre . $profile->first_name . ' ' . $profile->last_name;
      }
    }

    return $name;
  }

  public function patientProfile()
  {
    return $this->hasOne('App\PatientProfile');
  }

  public function chat()
  {
    return $this->hasOne('App\Chat\ChatList');
  }

  public function doctorProfile()
  {
    return $this->hasOne('App\DoctorProfile');
  }

  public function social()
  {
    return $this->hasOne('App\Social');
  }

  public function patientToDoctor()
  {
    return $this->hasMany('App\PatientToDoctor');
  }

  public function uploadedFiles()
  {
    return $this->hasMany('App\UploadedFiles');
  }

  public function prescription()
  {
    return $this->hasMany('App\Prescription');
  }

  public function medicalRecord()
  {
    return $this->hasMany('App\MedicalRecord');
  }

  public function patientDiseases()
  {
    return $this->hasOne('App\PatientDiseases');
  }

  public function onlineStore()
  {
    return $this->hasMany('App\OnlineStore');
  }

  public function chatMessages()
  {
    return $this->hasMany('App\ChatMessage');
  }
}
