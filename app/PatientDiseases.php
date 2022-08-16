<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDiseases extends Model
{
    protected $fillable = ['data'];

    public function user() {
        $this->belongsTo('App\User');
    }
}
