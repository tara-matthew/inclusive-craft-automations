<?php

use App\Http\Controllers\StoreAppointmentController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/appointments/create', 'appointments.create')->name('appointments.create');
Route::post('/appointments', StoreAppointmentController::class)->name('appointments.store');

Route::get('/emails/confirmation-preview/{appointment}', function (Appointment $appointment) {
    return view('emails.confirmation', compact('appointment'));
});
