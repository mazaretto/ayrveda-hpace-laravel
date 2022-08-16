<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function en() {
        session(['locale'=> 'en']);
        return back();
    }

    public function ru() {
        session(['locale'=> 'ru']);
        return back();
    }
}
