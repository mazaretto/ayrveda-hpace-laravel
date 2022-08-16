<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportList extends Model
{
    protected $fillable = ['userID'];

    public function messages(){
      return $this->hasMany(SupportMessage::class, 'token');
    }
}
