<?php

namespace App\Http\Controllers;

use App\Jobs\PaymentVerificationCheckerJob;
use App\Models\reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class reservationsController extends Controller
{

    public function view(Request $req){
        $thisClass = $this;


        return view("reservations",
        [
            "res"=>$thisClass->getUnaviabledates()
        ]
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
            "resDate"=> "required",
            "init_hour"=>"required",
            "end_hour"=>"required",
        ]);

        $res = $req->user()->reservations()->create([
            "resDate"=>$req->resDate,
            "init_hour"=>$this->parseHour($req->init_hour),
            "end_hour"=>$this->parseHour($req->end_hour),
        ]);

        PaymentVerificationCheckerJob::dispatch($res)->delay(now()->addMinutes(60));

        return redirect()->route("viewRes");
    }

    public function parseHour($hour){
        return Carbon::parse($hour)->format("h:m:s");
    }

    public function destroy(reservation $res){
        $res->refoundOrDelete();
        return response()->json(['success' => 'success'], 200);
    }

}


