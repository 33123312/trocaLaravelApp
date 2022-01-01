<?php

use App\Http\Controllers\emailController;
use App\Http\Controllers\forgotPassController;
use App\Http\Controllers\ISesionController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\reservationsController;
use App\Http\Controllers\upPayMthController;
use App\Http\Controllers\viewResController;
use Illuminate\Support\Facades\Route;

Route::get('/registrarse', [registerController::class,"view"])->name("registrarse");
Route::post('/registrarse', [registerController::class,"store"]);

Route::get('/iSesion', [ISesionController::class,"view"])->name("iSesion");
Route::post('/iSesion', [ISesionController::class,"store"]);

Route::middleware("verified")->group(function(){
    Route::get('/reservation', [reservationsController::class,"view"])->name("reservation");
    Route::post('/reservation', [reservationsController::class,"store"]);
    Route::delete('/reservation/{res}', [reservationsController::class,"destroy"])->name("reservation.del");
});



Route::post("/logOut",[LogOutController::class,"store"])->name("LogOut");

Route::get("/viewRes",[viewResController::class,"view"])->name("viewRes");

Route::get('/', [landingController::class,"index"])->name("landing");

Route::post('/payMth', [upPayMthController::class,"update"])->name("payMth");

Route::get('/email/verify',[emailController::class,"index"] )->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [emailController::class,"send"])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification',[emailController::class,"reSend"] )->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', [forgotPassController::class,"index"])->middleware('guest')->name('password.request');

Route::post('/forgot-password',[forgotPassController::class,"link"])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}',[forgotPassController::class,"restoreIndex"] )->middleware('guest')->name('password.reset');

Route::post('/reset-password',[forgotPassController::class,"restore"])->middleware('guest')->name('password.update');

Route::get('/oauth/{dri}',[registerController::class,"oauthFac"])->name("fac-log");

Route::get('/oauth/{dri}/call',[registerController::class,"oauthFacCall"]);

Route::delete("/deleteUser");