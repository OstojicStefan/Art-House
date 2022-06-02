<?php

namespace App\Http\Controllers\nikola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MailController extends Controller
{

    function sendTestMail()
    {

        mail("arthousemailer@gmail.com", "Test slanje", "Ovo je test", "From: arthouse@gmail.com");
    }
}
