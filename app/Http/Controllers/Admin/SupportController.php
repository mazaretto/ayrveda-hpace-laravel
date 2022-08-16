<?php

namespace App\Http\Controllers\Admin;

use App\Events\SupportSent;
use App\Http\Controllers\Controller;
use App\SupportList;
use Illuminate\Http\Request;

class SupportController extends Controller
{
  public function index()
  {
    $support = SupportList::all();
    foreach ($support as $item) {
      $item['last_message'] = $item->messages()->latest()->first();
    }

    return view('admin.support', ['supports' => $support]);
  }

  public function showToken()
  {
    $data = request()->validate([
      'token' => 'required'
    ]);

    $support = SupportList::findorfail($data['token']);
    $messages = $support->messages()->get();

    return $messages;
  }

  public function send(Request $request)
  {
    $data = $request->validate([
      'token' => 'required|numeric',
      'data' => 'required|string',
    ]);

    $support = SupportList::find($data['token']);

    if (!$support) {
      SupportList::delete($data['token']);
      return redirect()->route('admin.support');
    }

    $message = $support->messages()->create([
      'send_to' => 'user',
      'data' => $data['data'],
    ]);

    broadcast(new SupportSent($message))->toOthers();

    return ['status' => 1];
  }

  public function deleteToken(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|numeric'
    ]);

    $support = SupportList::findorfail($data['id']);

    $support->messages()->delete();
    $support->delete();

    return redirect()->route('admin.support');
  }
}
