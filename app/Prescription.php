<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['from_id', 'medicine_id', 'date', 'name', 'file'];

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
