<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;

class reservationsController extends Controller
{

    public function view(Request $req){
        $thisClass = $this;
        return view("reservations",
        [
            "res"=>$thisClass->getUnaviabledates(),
            "hpm"=>$req->user()->hasDefaultPaymentMethod()]
        );
    }

    private function getUnaviableDates(){
        $reservations = reservation::all();
        $res = array();
        
        foreach($reservations as $reservation)
            array_push($res,$reservation->resDate);

        return $res;
    }

    public function store(Request $req){
        $this->validate($req,[
            "resDate"=> "required"
        ]);

        $req->user()->reservations()->create([
            "resDate"=>$req->resDate
        ]);

        return redirect()->route("landing");
    }

    public function destroy(reservation $res){
        $res->delete();
        return back();
    }

}


