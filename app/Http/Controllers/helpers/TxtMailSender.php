<?php
namespace App\Http\Controllers\helpers;

use App\Jobs\emailSenderJob;
use App\Mail\TxtMail;
use Illuminate\Support\Facades\Mail;
use App\Models\reservation;
use App\Models\User;

class TxtMailSender{

    public static function send($user,$msg){
    
        //emailSenderJob::dispatch($user,$msg);
        Mail::
        to($user)->
        queue(new TxtMail($user,$msg));

    }

    public static function sendResCancelationMail(reservation $res,$msg){
        $user = $res->user;
        $defMsg = "La administración ha cancelado tu reservación del día " . $res->resDate ;
        $fullMsg = $defMsg . $msg;

        TxtMailSender::send($user,$fullMsg);

    }


}