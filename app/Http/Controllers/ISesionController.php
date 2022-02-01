<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ISesionController extends Controller
{
    function view(){

        return view("iSesion");
    }

    function store(Request $req){
        $this->validate($req,
            [
                "email"=> "required",
                "password"=> "required"
            ]
        );

        if(
            Auth::guard('admin')->attempt($this->toAdmin($req)) || 
            Auth::attempt($req->only("email","password"))
        ){
            return redirect()->route("landing");
        } else {
            return back() -> with("status","Contraseña o correo incorrecto");
        }        
        
    } 


    private function toAdmin($cred)
    {
        return     
        [
            "name"=>$cred->email,
            "password"=>$cred->password,
        ];
    }
}
