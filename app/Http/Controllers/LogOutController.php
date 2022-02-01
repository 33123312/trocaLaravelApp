<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    function store(){
        Auth::logout();

        return redirect()->route("landing");
    }

    function adminLog()
    {
        Auth::guard("admin")->logout();
        return redirect()->route("landing");
    }
}
