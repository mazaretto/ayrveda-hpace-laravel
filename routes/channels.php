<?php

use App\Chat\ChatList;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('Chat.ID.{chat}', function ($user, $chat) {
  $chat = ChatList::find($chat);
  $inChat = false;

  if ($user->id === $chat->user_id or $user->id === $chat->chat) $inChat = true;

  return $inChat;
});

Broadcast::channel('Support.ID.{id}', function ($user, $id) {
  $inChat = false;
  if ($user->hasRole('Admin')){
    $inChat = true;
  } else {
    $support = \App\SupportList::find($id);
    if ($support->userID == request()->session()->get('_token')){
      $inChat = true;
    }
  }

  return $inChat;
});
