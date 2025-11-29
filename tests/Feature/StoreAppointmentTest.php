<?php

use Carbon\Carbon;

it('stores an appointment and appointment reminder when creating a new customer', function () {
    Carbon::setTestNow(Carbon::parse('2010-03-31 12:00:00'));

    $response = $this->postJson(route('api.appointments.store'), [
        'name' => 'Bobby Newport',
        'email' => 'bobby-newport@hotmail.com',
        'scheduled_at' => now()->addDays(2)->format('Y-m-d H:i:s'),
    ])
        ->assertCreated();

    $appointmentId = $response->json('data.id');

    $this->assertDatabaseHas('customers', [
        'name' => 'Bobby Newport',
        'email' => 'bobby-newport@hotmail.com',
    ]);

    $this->assertDatabaseHas('appointment_reminders', [
        'appointment_id' => $appointmentId,
        'send_at' => now()->addDay()->format('Y-m-d H:i:s'),
    ]);
});
