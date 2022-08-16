<?php

namespace App\Chat;

use Illuminate\Database\Eloquent\Model;

class ChatList extends Model
{
    protected $fillable = ['chat'];

    public function user(){
        $this->belongsTo('App\User');
    }
}
