<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function chats(Request $request)
    {
        return Chat::all();
    }

    public function messages(Request $request, $roomId)
    {
        $messages = Message::where('chat_id', $roomId)
        ->with('user')
        ->orderBy('created_at', 'DESC')->paginate(10);

        return $messages;
    }

    public function newMessage(Request $request, $roomId)
    {
        $newMessage = new Message();
        $newMessage->user_id = auth()->id();
        $newMessage->chat_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save(); 

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;
    }
}
