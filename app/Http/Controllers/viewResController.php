<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewResController extends Controller
{

    public function view(Request $req){
        $res = $req->user()->reservations;
        $refounded = 
        $req->
            user()->
            reservations()->
            onlyTrashed()->
            whereHas('reservationToRefound')->
            with("reservationToRefound")->
            get();
        return view("viewRes",
            ["ress"=>$res,
             "ref"=>$refounded]);
    }
}
