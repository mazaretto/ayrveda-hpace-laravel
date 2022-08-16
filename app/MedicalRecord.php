<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = ['from_id','date','description','file','file_name'];

    public function user(){
        $this->belongsTo('App\User');
    }
}
