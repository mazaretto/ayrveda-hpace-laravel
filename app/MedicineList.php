<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MedicineList extends Model
{
  protected $fillable = ['name', 'price', 'image', 'description', 'gallery', 'description', 'sostav', 'doz', 'protiv', 'manufacter', 'manufacter_address', 'manufacter_phone', 'diseases'];

  public static function destroy($ids)
  {
    $file = MedicineList::find($ids);

    Storage::disk('public')->delete($file->image);
    foreach (explode(',', $file->gallery) as $item) {
      if ($item != '') {
        Storage::disk('public')->delete($item);
      }
    }

    return parent::destroy($ids);
  }
}
