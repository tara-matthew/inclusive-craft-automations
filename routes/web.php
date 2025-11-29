<?php

use App\Http\Controllers\StoreAppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/appointments/create', 'appointments.create')->name('appointments.create');
Route::post('/appointments', StoreAppointmentController::class)->name('appointments.store');
