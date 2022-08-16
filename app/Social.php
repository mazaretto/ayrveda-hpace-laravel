<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['facebook', 'twitter', 'instagram', 'pinterest', 'linkedin', 'youtube'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
