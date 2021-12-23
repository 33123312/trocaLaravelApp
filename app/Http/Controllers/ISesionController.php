<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ISesionController extends Controller
{
    function view(){

        return view("iSesion");
    }

    function store(Request $req){
        $this->validate($req,
            [
                "email"=> "required|email",
                "password"=> "required"
            ]
        );


        $logged = auth()->attempt($req->only("email","password"));
        if(!$logged)
            return back() -> with("status","Contraseña o correo incorrecto");

        return redirect()->route("landing");
    } 
}
