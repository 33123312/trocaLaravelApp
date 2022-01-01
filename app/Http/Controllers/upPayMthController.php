<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class upPayMthController extends Controller
{
    public function update(Request $req){
        $user = $req->user();

        try {

            $user->createOrGetStripeCustomer();
            
            if($req->payment_method)
                $user->updateDefaultPaymentMethod($req->payment_method);
            
            $payMet = $user->defaultPaymentMethod();

            $user->charge(10,$payMet);

        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

    }
}
