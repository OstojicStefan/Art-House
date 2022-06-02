<?php

//Stefan Ostojic, 18/442
//Ovaj kontroler se bavi funkcionalnostima cetovanja tokom same izlozbe

namespace App\Http\Controllers\stefan;

use App\Http\Controllers\Controller;
use App\Models\stefan\AllMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{   
    function __construct() {
        $this->middleware('registred');
    }

    //trenutno se ne koristi funkcija
    public function chatBoxInit($exhID)
    {
        $id = Session::get('IDUser');

        $allMessages = new AllMessages();

        $chatbox = $allMessages->where('IDExh', $exhID)->orderBy('IDMes', 'asc')->get();

        return view('nikola/exhibition', ['chatbox', $chatbox]);
    }


    //Funkcija koja regulise slanje poruke serveru
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
