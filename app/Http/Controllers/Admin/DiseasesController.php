<?php

namespace App\Http\Controllers\Admin;

use App\Diseases;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiseasesController extends Controller
{
    public function index()
    {
        $diseases = Diseases::first();
        if ($diseases !== null) {
            $diseases = json_decode($diseases->data);
        }
        return view('admin.diseases-list', ['diseases' => $diseases]);
    }

    public function set(Request $request)
    {
        $data = $request->validate([
            'data' => 'required',
        ]);

        if (!Diseases::all()->isEmpty()) {
            Diseases::truncate();
        }

        Diseases::create($data);

        return response()->json('ok');
    }
}
