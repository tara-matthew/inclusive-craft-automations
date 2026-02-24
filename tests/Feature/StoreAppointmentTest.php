<?php

use App\Models\Appointment;
use App\Models\AppointmentReminder;
use App\ReminderStatus;
use Carbon\Carbon;

it('stores an appointment and appointment reminder when creating a new customer', function () {
    Carbon::setTestNow(Carbon::parse('2010-03-31 12:00:00'));

    $this->post(route('appointments.store'), [
        'name' => 'Bobby Newport',
        'email' => 'bobby-newport@hotmail.com',
        'scheduled_at' => now()->addDays(2)->format('Y-m-d H:i:s'),
    ])
        ->assertRedirect();

    $this->assertDatabaseHas('customers', [
        'name' => 'Bobby Newport',
        'email' => 'bobby-newport@hotmail.com',
    ]);

    $this->assertDatabaseHas('appointment_reminders', [
        'appointment_id' => Appointment::first()->id,
        'send_at' => now()->addDay()->format('Y-m-d H:i:s'),
    ]);
});

it('rolls back updates when part of the request fails', function () {
    AppointmentReminder::creating(function () {
        throw new Exception('Server error');
    });

    $appointmentData = [
        'name' => 'David Rose',
        'email' => 'david@hotmail.com',
        'scheduled_at' => now()->addDays(7)->format('Y-m-d H:i:s'),
    ];

    $this->post(route('appointments.store'), $appointmentData)->assertServerError();

    $this->assertDatabaseMissing('customers', ['email' => 'john@example.com']);
    $this->assertDatabaseMissing('appointments', ['scheduled_at' => $appointmentData['scheduled_at']]);
    $this->assertDatabaseMissing('appointment_reminders', ['status' => ReminderStatus::UNPROCESSED]);
});
