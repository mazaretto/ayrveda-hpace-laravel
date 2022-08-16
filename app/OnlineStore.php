<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineStore extends Model
{
  protected $fillable = ['order_data', 'order_delivery', 'status'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
