<?php

use App\Events\AppointmentCreated;
use App\Listeners\SendAppointmentConfirmationNotification;
use App\Mail\AppointmentConfirmed;
use App\Models\Appointment;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


it('sends an appointment confirmation notification to the customer when appointment created event is dispatched', function () {
    Mail::fake();

    $customer = Customer::factory()->create([
        'email' => 'test@example.com',
        'name' => 'John Doe'
    ]);

    $appointment = Appointment::factory()->for($customer)->create();

    AppointmentCreated::dispatch($appointment);

    Mail::assertSent(AppointmentConfirmed::class, function ($mail) use ($customer) {
        return $mail->hasTo($customer->email);
    });
});
