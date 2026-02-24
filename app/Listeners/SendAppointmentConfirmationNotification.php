<?php

namespace App\Listeners;

use App\Events\AppointmentCreated;
use App\Mail\AppointmentConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendAppointmentConfirmationNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AppointmentCreated $event): void
    {
        Mail::to($event->appointment->customer)->send(new AppointmentConfirmed($event->appointment));
    }
}
