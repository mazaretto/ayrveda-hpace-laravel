<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientToDoctor extends Model
{
    protected $fillable = ['doctor_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
