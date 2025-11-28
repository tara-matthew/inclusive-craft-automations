<?php

use App\Http\Controllers\StoreAppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/appointments', StoreAppointmentController::class)->name('appointments.store');
