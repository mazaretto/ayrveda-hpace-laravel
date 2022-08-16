<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\MedicineList;
use Illuminate\Http\Request;

class CartController extends Controller
{
  private $available_types = [
    'medicine',
  ];

  public function add(Request $request)
  {
    $data = $request->validate([
      'type' => 'required|string',
      'id' => 'required|numeric',
      'quantity' => 'required|numeric',
    ]);

    if (!in_array($data['type'], $this->available_types)) {
      return abort(404);
    }

    $current_cart = session('cart');

    if (!$current_cart) {
      $new_cart = [
        $data['type'] => [
          $data['id'] => [
            'quantity' => $data['quantity'],
            'id' => $data['id'],
          ]
        ]
      ];
    } else {
      $current_cart = $current_cart->all();

      if ($current_cart[$data['type']][$data['id']] ?? false) {
        $quantity = $current_cart[$data['type']][$data['id']]['quantity'] + $data['quantity'];
        $current_cart[$data['type']][$data['id']]['quantity'] = $quantity;
      } else {
        $current_cart[$data['type']][$data['id']] = [
          'quantity' => $data['quantity'],
          'id' => $data['id'],
        ];
      }

      $new_cart = $current_cart;
    }

    session()->put(['cart' => collect($new_cart)]);
    return back();
  }

  public function changeQuantity(Request $request)
  {
    {
      $data = $request->validate([
        'type' => 'required|string',
        'id' => 'required|numeric',
        'quantity' => 'required|numeric',
      ]);

      if (!in_array($data['type'], $this->available_types)) {
        return abort(404);
      }

      $current_cart = session('cart');

      if (!$current_cart) {
        $new_cart = [
          $data['type'] => [
            $data['id'] => [
              'quantity' => $data['quantity'],
              'id' => $data['id'],
            ]
          ]
        ];
      } else {
        $current_cart = $current_cart->all();

        if ($current_cart[$data['type']][$data['id']] ?? false) {
          $current_cart[$data['type']][$data['id']]['quantity'] = $data['quantity'];
        } else {
          $current_cart[$data['type']][$data['id']] = [
            'quantity' => $data['quantity'],
            'id' => $data['id'],
          ];
        }

        $new_cart = $current_cart;
      }

      session()->put(['cart' => collect($new_cart)]);
      return response()->json('changed');
    }
  }

  public function remove(Request $request)
  {
    $data = $request->validate([
      'type' => 'required|string',
      'id' => 'required|numeric',
    ]);

    if (!in_array($data['type'], $this->available_types)) {
      return abort(404);
    }

    $current_cart = session('cart');

    if (!$current_cart) {
      return response()->json('not exists');
    } else {
      $current_cart = $current_cart->all();
      if ($current_cart[$data['type']][$data['id']] ?? false) {
        unset($current_cart[$data['type']][$data['id']]);
        $new_cart = $current_cart;

        session()->put(['cart' => collect($new_cart)]);
        return response()->json('removed');
      }
      return response()->json('not exists');
    }
  }

  public static function total()
  {
    $current_cart = session('cart');

    if (!$current_cart) {
      return null;
    } else {
      $current_cart = $current_cart->all();
      $total = 0;

      foreach ($current_cart as $cart_category) {
        foreach ($cart_category as $cart_item) {
          $total += $cart_item['quantity'];
        }
      }

      if ($total == 0) $total = null;
      return $total;
    }
  }

  public function getPrice()
  {
    $cart = session()->get('cart');
    $total_price = 0;
    foreach ($cart as $category => $cart_category) {
      if (!in_array($category, $this->available_types)){
        session()->forget('cart');
        abort(404);
      }
      foreach ($cart_category as $cart_item) {
        if ($category == 'medicine') {
          $medicine = MedicineList::find($cart_item['id']);

          $cart_item['quantity'] = intval($cart_item['quantity']);
          $medicine->price = floatval($medicine->price);

          $price = round(($medicine->price ?? 0) * $cart_item['quantity'], 2);
          $total_price += $price;
        }
      }
    }

    return $total_price;
  }

  public function cartProceed(Request $request)
  {
    $data_delivery = $request->validate([
      'country' => 'required|string',
      'state' => 'required|string',
      'city' => 'required|string',
      'zip_code' => 'required|string',
      'address' => 'required|string',
    ]);

    $cart = session()->get('cart');
    session()->forget('cart');
    $data = [];
    $total_price = 0;
    foreach ($cart as $category => $cart_category) {
      if (!in_array($category, $this->available_types)) abort(404);
      foreach ($cart_category as $cart_item) {
        if ($category == 'medicine') {
          $medicine = MedicineList::find($cart_item['id']);

          $cart_item['quantity'] = intval($cart_item['quantity']);
          $medicine->price = floatval($medicine->price);

          $price = round(($medicine->price ?? 0) * $cart_item['quantity'], 2);
          $data[] = [
            'type' => $category,
            'quantity' => $cart_item['quantity'],
            'product_id' => $cart_item['id'],
            'product_name' => $medicine->name ?? null,
            'product_price' => $medicine->price ?? null,
            'product_total' => $price,
          ];
          $total_price += $price;
        }
      }
    }
    $data['total_price'] = $total_price;

    auth()->user()->onlineStore()->create([
      'order_data' => json_encode($data ?? ''),
      'order_delivery' => json_encode($data_delivery ?? ''),
    ]);

    return redirect()->route('patient.purchase-history');
  }
}
