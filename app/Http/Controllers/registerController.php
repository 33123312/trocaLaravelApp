<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function view()
    {
        return view("register");
    }

    public function store(Request $req)
    {

        $this->validate($req,
            [
                "firstn"=> "required",
                "lastn"=> "required",
                "pnumber"=> "required",
                "email"=> "required|email",
                "password"=> "required|confirmed"
            ]
        );

        $info = [
            "firstn" => $req->firstn,
            "lastn" => $req->lastn,
            "pnumber" => $req->pnumber,
            "email" => $req->email,
            "password" => Hash::make($req->password)
        ];

        User::create(
            $info
        );

        auth()->attempt($req->only("email","password"));
        
        return redirect()->route("landing");
    }
}

