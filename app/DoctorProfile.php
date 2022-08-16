<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $fillable = ['photo', 'first_name', 'last_name', 'patronymic', 'birth', 'blood_group', 'country', 'state', 'city', 'zip_code', 'address'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
