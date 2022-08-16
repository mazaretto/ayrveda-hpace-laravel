<?php

namespace App\Http\Controllers;

use App\Chat\ChatList;
use App\ChatMessage;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Sodium\add;

class ChatController extends Controller
{
  public function index()
  {
    if(\request()->id) {
      $this->addChat(\request());
    }

    $chatList = ChatList::where('user_id', auth()->user()->id)->orWhere('chat', auth()->user()->id)->get();
    $chats = [];

    foreach ($chatList as $chat) {
      if ($chat->user_id == auth()->user()->id) {
        $user = User::find($chat->chat);
      } else {
        $user = User::find($chat->user_id);
      }
      if ($user == null) {
        ChatList::destroy($chat->id);
        continue;
      }

      $user = $this->userDetails($user);

      if ($chat->user_id == auth()->user()->id) {
        $chat_find = $chat->chat;
      } else {
        $chat_find = $chat->user_id;
      }

      $last_message = ChatMessage::where([
        ['user_id', auth()->user()->id],
        ['user_to_id', $chat_find],
      ])->orWhere([
        ['user_to_id', auth()->user()->id],
        ['user_id', $chat_find],
      ])->latest()->first();

      $unread = ChatMessage::where([
        ['user_id', $chat_find],
        ['user_to_id', auth()->user()->id],
        ['read', false],
      ])->count();

      $chats[] = ['name' => $user['name'], 'photo' => $user['photo'], 'id' => $user['id'], 'unread' => $unread,
        'last_message' => ['time' => $last_message->created_at??null, 'data' => $last_message->data??null, 'isFile' => $last_message->attachment??null,
          'isSent' => $last_message->user_id??null == auth()->user()->id
        ]
      ];
    }

    return view('chat', ['user' => auth()->user(), 'chats' => json_encode($chats), 'chat_init' => request()->id]);
  }

  public function read(Request $request){
    $data = $request->validate([
      'chatID' => 'required',
    ]);

    ChatMessage::where([
      ['user_id', $data['chatID']],
      ['user_to_id', auth()->user()->id],
      ['read', false],
    ])->update(['read' => true]);

    return ['status' => 1];
  }

  public function addChat(Request $request)
  {
    $role = mb_substr($request->id, 0, 1);
    $id = mb_substr($request->id, 1);
    $user = User::find($id);
    if ($user == null) return response()->json(['status' => 'fail', 'message' => trans('chat.fail-not-found')]);
    switch ($role) {
      case 'P':
        if (!$user->hasRole('Patient')) {
          return response()->json(['status' => 'fail', 'message' => trans('chat.fail-not-found')]);
        }
        if ($user->hasRole('Patient') and $id == auth()->user()->id) {
          return response()->json(['status' => 'fail', 'message' => trans('chat.fail-self')]);
        }

        $chat = ChatList::where([
          ['user_id', auth()->user()->id],
          ['chat', $user->id],
        ])->orWhere([
          ['user_id', $user->id],
          ['chat', auth()->user()->id],
        ])->get();
        if ($chat->isEmpty()) {
          auth()->user()->chat()->create(['chat' => $id]);
          return response()->json(['status' => 'ok', 'message' => trans('chat.patient-ok')]);
        } else {
          return response()->json(['status' => 'fail', 'message' => trans('chat.fail-exist')]);
        }
        break;
        break;
      case 'D':
        if (!$user->hasRole('Doctor')) {
          return response()->json(['status' => 'fail', 'message' => trans('chat.fail-not-found')]);
        }
        if ($user->hasRole('Doctor') and $id == auth()->user()->id) {
          return response()->json(['status' => 'fail', 'message' => trans('chat.fail-self')]);
        }

        $chat = ChatList::where([
          ['user_id', auth()->user()->id],
          ['chat', $user->id],
        ])->orWhere([
          ['user_id', $user->id],
          ['chat', auth()->user()->id],
        ])->get();
        if ($chat->isEmpty()) {
          auth()->user()->chat()->create(['chat' => $id]);
          return response()->json(['status' => 'ok', 'message' => trans('chat.doctor-ok')]);
        } else {
          return response()->json(['status' => 'fail', 'message' => trans('chat.fail-exist')]);
        }
        break;
    }
    return response()->json('error');
  }

  public function curUser()
  {
    $user = auth()->user();
    $user = $this->userDetails($user);

    return $user;
  }

  public function chatInfo()
  {
    $data = request()->validate([
      'id' => 'required|numeric'
    ]);

    $user = User::find($data['id']);
    if ($user == null) {
      ChatList::destroy($data['id']);
      return $user;
    }

    $user = $this->userDetails($user);
    $user['chat_id'] = ChatList::where([
      ['chat', $user['id']],
      ['user_id', auth()->user()->id]
    ])->orWhere([
      ['chat', auth()->user()->id],
      ['user_id', $user['id']]
    ])->first()->id;

    return $user;
  }

  private function userDetails(User $user)
  {
    $user['photo'] = '/assets/img/doctors/doctor-thumb-02.jpg';

    if ($user->hasRole('Patient')) {
      $profile = $user->patientProfile()->first();
      $user['link'] = route('doctor.my-patient', $user->id);
    } else if ($user->hasRole('Doctor')) {
      $profile = $user->doctorProfile()->first();
      $user['link'] = route('doctor-profile', $user->id);
    } else {
      return $this->extractUser($user);
    }

    if ($profile == null) {
      return $this->extractUser($user);
    }

    if ($profile->first_name ?? false and $profile->last_name ?? false and $profile->patronymic ?? false) {
      $user['name'] = $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
    }

    if (($profile->photo ?? null) != null) {
      $user['photo'] = Storage::url($profile->photo);
    }

    return $this->extractUser($user);
  }

  public function uploadSingle(Request $request) {
    $data = $request->validate([
      'file'=>'required|file',
    ]);

    if (!$data['file']){
      return ['status' => 0];
    }
    $file = $data['file'];
    $response = [];

    $response['file'] = Storage::disk('public')->put('chat/'.auth()->user()->id.'/uploads/', $file);
    $response['file'] = Storage::url($response['file']);

    $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
    $contentType = mime_content_type(substr($response['file'], 1));

    if (in_array($contentType, $allowedMimeTypes)) {
      $response['image'] = true;
    } else {
      $response['image'] = false;
    }

    return $response;
  }

  private function extractUser($user) {
    unset($user['password'], $user['created_at'], $user['updated_at'], $user['email_verified_at'], $user['remember_token'], $user['active'], $user['roles']);

    $user_temp = null;
    foreach ($user->getAttributes() as $key => $value) {
      $user_temp[$key] = $value;
    }

    return $user_temp;
  }

  public function fetch()
  {
    $data = request()->validate([
      'id' => 'required'
    ]);

    $messages = ChatMessage::where([
      ['user_id', auth()->user()->id],
      ['user_to_id', $data['id']]
    ])->orWhere([
      ['user_id', $data['id']],
      ['user_to_id', auth()->user()->id]
    ])->latest()->limit(100)->get()->sortBy('created_at')->values();

    return $messages;
  }

  public function send(Request $request)
  {
    $data = $request->validate([
      'data' => 'required',
      'chat_id' => 'required|numeric',
      'attachment' => 'required|boolean',
    ]);

    $user = auth()->user();
    if (!$data['attachment']) {
      $message = $user->chatMessages()->create([
        'user_to_id' => $data['chat_id'],
        'data' => $data['data'],
        'attachment' => $data['attachment'],
      ]);
    } else {
      $message = $user->chatMessages()->create([
        'user_to_id' => $data['chat_id'],
        'data' => '',
        'attachment' => $data['attachment'],
        'file' => $data['data']['file'],
        'name' => $data['data']['name'],
        'image' => $data['data']['image'],
      ]);
    }

    $chat = ChatList::where([
      ['chat', $data['chat_id']],
      ['user_id', $user->id]
    ])->orWhere([
      ['chat', $user->id],
      ['user_id', $data['chat_id']]
    ])->first();

    broadcast(new MessageSent($chat, $message))->toOthers();

    return $message;
  }

  public function attachment()
  {
    $user = auth()->user();

    if (!$user->hasRole('Patient')) {
      return [];
    }

    $files = $user->uploadedFiles()->get();

    $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];

    foreach ($files as $file) {
      $file->file = Storage::url($file->file);
      $contentType = mime_content_type(substr($file->file, 1));

      if (in_array($contentType, $allowedMimeTypes)) {
        $file['image'] = true;
      } else {
        $file['image'] = false;
      }
    }

    return $files;
  }

  public function trans(Request $request)
  {
    $data = $request->validate([
      'keys' => 'required|array'
    ]);

    $res = [];
    foreach ($data['keys'] as $key) {
      $res[] = trans($key);
    }

    return $res;
  }
}
