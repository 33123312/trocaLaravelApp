<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewResController extends Controller
{

    public function view(Request $req){
        $res = $req->user()->reservations;
        return view("viewRes",["ress"=>$res]);
    }
}
