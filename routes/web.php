<?php

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

Route::get('/reservation', [reservationsController::class,"view"])->name("reservation");
Route::post('/reservation', [reservationsController::class,"store"]);
Route::delete('/reservation/{res}', [reservationsController::class,"destroy"])->name("reservation.del");

Route::post("/logOut",[LogOutController::class,"store"])->name("LogOut");

Route::get("/viewRes",[viewResController::class,"view"])->name("viewRes");

Route::get('/', [landingController::class,"index"])->name("landing");

Route::post('/payMth', [upPayMthController::class,"update"])->name("payMth");




