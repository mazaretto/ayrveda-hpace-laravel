<?php

namespace App\Http\Controllers;

use App\Events\SupportSent;
use App\SupportList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('index');
  }

  public function identify(Request $request) {
    $userID = request()->session()->get('_token');

    $supp = SupportList::where('userID', $userID)->first();

    if ($supp == []) {
      $supp = SupportList::create([
        'userID' => $userID,
      ]);
    }
    return [$userID, $supp->id];
  }

  public function resetToken(){
    $user_id = request()->session()->get('_token');
    request()->session()->forget('_token');
    $supports = SupportList::where('userID', $user_id)->get();
    foreach ($supports as $support) {
      $support->messages()->delete();
      $support->delete();
    }

    return ['status' => 1];
  }

  public function supportSend(Request $request) {
    $data = $request->validate([
      'message' => 'required|string',
    ]);
    $userID = request()->session()->get('_token');
    $support = SupportList::where([
      ['userID', $userID],
    ])->latest()->first();

    $message = $support->messages()->create([
      'send_to' => 'support',
      'data' => $data['message'],
    ]);

    broadcast(new SupportSent($message))->toOthers();

    return ['status' => 1];
  }

  public function fetchCur(){
    $userID = request()->session()->get('_token');

    $support = SupportList::where('userID', $userID)->latest()->first();

    if (!$support) {
      return [];
    } else {
      return $support->messages()->select('send_to', 'data')->get();
    }
  }
}
