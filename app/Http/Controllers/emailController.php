<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class emailController extends Controller
{

    public function index() {
        return view('verify-email');
    }

    public function send(EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect()->route("landing");
    }

    public function reSend(Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Se ha mandado el link de verificación!');
    }

}
