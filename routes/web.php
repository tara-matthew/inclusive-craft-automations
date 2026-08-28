<?php

use App\Http\Controllers\IndexAppointmentsController;
use App\Http\Controllers\StoreAppointmentController;
use App\Http\Controllers\UpdateAppointmentController;
use App\Http\Controllers\VerifyPinController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/pin', 'pin')->name('pin.form');
Route::post('/pin', VerifyPinController::class)->name('pin.verify');

Route::middleware('pin')->group(function () {
    Route::get('/appointments', IndexAppointmentsController::class)->name('appointments.index');
    Route::view('/appointments/create', 'appointments.create')->name('appointments.create');
    Route::post('/appointments', StoreAppointmentController::class)->name('appointments.store');
    Route::patch('/appointments/{appointment}', UpdateAppointmentController::class)->name('appointments.update');

    Route::get('/emails/confirmation-preview/{appointment}', function (Appointment $appointment) {
        return view('emails.confirmation', compact('appointment'));
    });

    Route::get('/emails/appointment-reminders/{appointment}', function (Appointment $appointment) {
        return view('emails.reminder', compact('appointment'));
    });
});
