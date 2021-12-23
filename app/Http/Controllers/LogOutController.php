<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogOutController extends Controller
{
    function store(){
        auth()->logout();

        return redirect()->route("landing");
    }
}
