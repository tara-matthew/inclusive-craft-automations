<?php

use App\Models\Appointment;
use App\Models\AppointmentReminder;
use App\Models\Customer;

it('lists appointments with customer details and reminder due dates', function () {
    $customer = Customer::factory()->create([
        'name' => 'Ann Perkins',
        'email' => 'ann@example.com',
    ]);
    $appointment = Appointment::factory()->for($customer)->create([
        'scheduled_at' => now()->addDays(3)->setTime(10, 0),
    ]);
    $reminder = AppointmentReminder::factory()->for($appointment)->unprocessed()->create();

    $this->withSession(['pin_verified' => true])
        ->get(route('appointments.index'))
        ->assertSuccessful()
        ->assertSee('Ann Perkins')
        ->assertSee('ann@example.com')
        ->assertSee($appointment->scheduled_at->format('dS M H:i'))
        ->assertSee($reminder->send_at->format('dS M H:i'))
        ->assertSee('unprocessed');
});

it('requires pin verification to view the appointments list', function () {
    $this->get(route('appointments.index'))
        ->assertRedirect(route('pin.form'));
});

it('only lists upcoming appointments by default', function () {
    $past = Appointment::factory()->create([
        'scheduled_at' => now()->subDays(3),
    ]);
    $upcoming = Appointment::factory()->create([
        'scheduled_at' => now()->addDays(3),
    ]);

    $this->withSession(['pin_verified' => true])
        ->get(route('appointments.index'))
        ->assertSuccessful()
        ->assertSee($upcoming->customer->name)
        ->assertDontSee($past->customer->name);
});

it('lists past appointments when requested', function () {
    $past = Appointment::factory()->create([
        'scheduled_at' => now()->subDays(3),
    ]);
    $upcoming = Appointment::factory()->create([
        'scheduled_at' => now()->addDays(3),
    ]);

    $this->withSession(['pin_verified' => true])
        ->get(route('appointments.index', ['status' => 'past']))
        ->assertSuccessful()
        ->assertSee($past->customer->name)
        ->assertDontSee($upcoming->customer->name);
});

it('lists all appointments when requested', function () {
    $past = Appointment::factory()->create([
        'scheduled_at' => now()->subDays(3),
    ]);
    $upcoming = Appointment::factory()->create([
        'scheduled_at' => now()->addDays(3),
    ]);

    $this->withSession(['pin_verified' => true])
        ->get(route('appointments.index', ['status' => 'all']))
        ->assertSuccessful()
        ->assertSee($past->customer->name)
        ->assertSee($upcoming->customer->name);
});
