<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


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

        $user = User::create($info);
        event(new Registered($user));


        auth()->attempt($req->only("email","password"));
        
        return redirect()->route("verification.notice");
    }

    public function oauthFac($dri){
        return Socialite::driver($dri)->redirect();
    }

    public function oauthFacCall($dri){
        $user = Socialite::driver($dri)->user()
        ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
        ->user();

        dd($user);

        //return redirect()->route("landing");
    }
}

