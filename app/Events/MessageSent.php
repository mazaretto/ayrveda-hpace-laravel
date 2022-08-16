<?php

namespace App\Events;

use App\Chat\ChatList;
use App\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $chat;
  public $message;

  public function __construct(ChatList $chat, ChatMessage $message)
  {
    $this->chat = $chat;
    $this->message = $message;
  }

  public function broadcastOn()
  {
    return new PrivateChannel("Chat.ID." . $this->chat->id);
  }
}
