<?php

namespace App\Http\Controllers;

use App\Jobs\NotificationsReaderJob;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
     public function index(Request $req){
        $user = $req->user();
        $notifications = $user ->notifications;

        NotificationsReaderJob::dispatch($user);

        return view("notifications",["nots"=>$notifications]);
    }

    
 
}
