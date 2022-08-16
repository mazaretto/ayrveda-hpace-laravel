<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
  protected $fillable = ['send_to', 'data'];

  public function support()
  {
    return $this->belongsTo(SupportList::class);
  }
}
