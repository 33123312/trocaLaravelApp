<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use App\Models\reservationToRefound;
use App\Models\User;
use App\Notifications\GenericNotification;
use App\Notifications\ReservationCancelledNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class resAdminController extends Controller
{
    function index(){
        $todayDate = date("Y-m-d");

        $reservations = Reservation::whereDate("resDate",'>=',$todayDate)->get();
        $reservationsToRefound = 
        Reservation::
        onlyTrashed()->
        whereHas('reservationToRefound')->
        with("reservationToRefound")->
        with("user")->
        get();
        

        return view("resAdmin",["res"=>$reservations,"ref"=>$reservationsToRefound]);
    }

    function store(Reservation $res){
        $res->payment_verified = 1;
        $res->save();

        $user = User::find($res->user_id);

        $user->notify(
            new GenericNotification(
                "Se ha confirmado tu pago para la reservación del día " . $res->resDate)
        );

        return response()->json(['success' => 'success'], 200);

    }

    function destroy(Request $req, Reservation $res){
        $res->makeFullRefound();

        $res->user->notify(
            new ReservationCancelledNotification(
                $res,
                $req->reason));

        return response()->json(['success' => 'success'], 200);
        
    }

    function refound(reservationToRefound $ref){
        $user =  $ref->reservation->user;
        $ref->delete();
        $user->notify(
            new GenericNotification(
                $user,
                "Se han reembolsado $" . $ref->amount . " por la cancelación del día " . $ref->resDate
            ));

        return response()->json(['success' => 'success'], 200);
        
    }

}
