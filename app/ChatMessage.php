<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
  protected $fillable = ['data', 'user_to_id', 'read', 'attachment', 'attachment', 'file', 'name', 'image'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
