<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    public function index() {
        $items = auth()->user()->onlineStore()->orderBy('created_at', 'desc')->get();

        if (!$items) $items = [];

        return view('patient.purchase-history', ['purchases' => $items]);
    }
}
