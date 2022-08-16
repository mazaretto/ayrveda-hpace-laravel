<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadedFiles extends Model
{
    protected $fillable = ['name', 'file'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
