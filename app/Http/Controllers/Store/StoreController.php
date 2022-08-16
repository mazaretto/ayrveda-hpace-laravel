<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\MedicineList;
use App\OnlineStore;
use Illuminate\Http\Request;

class StoreController extends Controller
{
  public function index()
  {
    $data = request()->validate([
      'price-min' => 'numeric',
      'price-max' => 'numeric',
      'name' => 'string',
      'manufacter' => 'array',
      'disease' => 'array',
    ]);

    $medicines = MedicineList::query()->select('*');

    if (request()->has('price-min') and request()->has('price-max')) {
      $data['price-min'] = floatval($data['price-min']);
      $data['price-max'] = floatval($data['price-max']);
      $medicines = $medicines->where([
        ['price', '>=', $data['price-min']],
        ['price', '<=', $data['price-max']],
      ]);
    }
    if (request()->has('manufacter')) {
      $medicines = $medicines->whereIn('manufacter', $data['manufacter']);
    }
    if (request()->has('disease')) {
      $medicines = $medicines->whereIn('diseases', $data['disease']);
    }
    if(isset($data['name'])) {
      $medicines = $medicines->where('name', 'LIKE', '%'.$data['name'].'%');
    }

    $medicines = $medicines->get();

    // Filters
    $max_price = 0;
    $manufacter_list = [];
//    $diseases_list = [];
    foreach (MedicineList::all() as $medicine) {
      $price = floatval(explode(' ', $medicine->price)[0]);
      if ($price >= $max_price) {
        $max_price = $price;
      }

      if ($medicine->manufacter and !in_array($medicine->manufacter, $manufacter_list)) {
        array_push($manufacter_list, $medicine->manufacter);
      }

      /*foreach (explode('\,/', $medicine->diseases) as $item) {
        if ($item and !in_array($item, $diseases_list)) {
          array_push($diseases_list, $item);
        }
      }*/
    }

    return view('store.online-store', ['medicines' => $medicines, 'max_price' => $max_price, 'manufacters' => $manufacter_list]);
  }

  public function showMedicine($id)
  {
    $medicine = MedicineList::findorfail($id);

    return view('store.medicine-single', ['medicine' => $medicine]);
  }

  public function cartPatient()
  {
    $cart = session()->get('cart');
    if (!$cart) {
      $cart = [];
    }

    return view('patient.cart', ['cart' => $cart]);
  }

  public function cartPatientDetails(){
    $cart = session()->get('cart');
    if (!$cart){
      abort(404);
    }

    return view('patient.cart-details');
  }

  public function adminIndex()
  {
    $orders = OnlineStore::where('status', 0)->get();

    return view('admin.online-store.online-store', ['orders' => $orders]);
  }

  public function adminIndexDismissed()
  {
    $orders = OnlineStore::where('status', -1)->get();

    return view('admin.online-store.online-store', ['orders' => $orders]);
  }

  public function adminIndexSuccessful()
  {
    $orders = OnlineStore::where('status', 1)->get();

    return view('admin.online-store.online-store', ['orders' => $orders]);
  }

  public function adminNext(Request $request) {
    $data = $request->validate([
      'id' => 'required|numeric',
      'dismiss' => 'required|boolean'
    ]);

    $order = OnlineStore::find($data['id']);
    if ($data['dismiss']) {
      $order->status = -1;
    } else {
      $order->status = $order->status + 1;
    }
    $order->save();

    return redirect()->route('admin.online-store');
  }

  public static function status($id)
  {
    $available_statuses = [
      -1 => trans('purchases.discarded'),
      0 => trans('purchases.processing'),
      1 => trans('purchases.successful'),
    ];

    return $available_statuses[$id] ?? null;
  }
}
