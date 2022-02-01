<?php

namespace App\Jobs;

use App\Http\Controllers\helpers\TxtMailSender;
use App\Models\reservation;
use App\Notifications\ReservationCancelledNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaymentVerificationCheckerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $res;

    public function __construct(reservation $res )
    {
        $this->res = $res;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $res = $this->res;
        $res->refresh();
        if(!$res->payment_verified){
            $res->user->notify(
                new ReservationCancelledNotification(
                    $res,
                    "el tiempo límite pare realizar el pago de la reservación ha expirado"));
            
            $res->forceDelete();
        }


    }
}
