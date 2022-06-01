<?php

namespace App\Http\Controllers\stefan;

use App\Http\Controllers\Controller;
use App\Models\stefan\AllMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{   
    //trenutno se ne koristi funkcija
    public function chatBoxInit($exhID)
    {
        $id = Session::get('IDUser');

        $allMessages = new AllMessages();

        $chatbox = $allMessages->where('IDExh', $exhID)->orderBy('IDMes', 'asc')->get();

        return view('nikola/exhibition', ['chatbox', $chatbox]);
    }

    public function sendMessageSubmit(Request $request)
    {
        $newMessage = new AllMessages();

        $newMessage->IDUser = $request->userID;
        $newMessage->IDExh = $request->exhID;
        $newMessage->Text = $request->textMsg;

        $newMessage->save();

        return redirect()->route('exhibition', ['id' => $newMessage->IDExh]);
    }
}
