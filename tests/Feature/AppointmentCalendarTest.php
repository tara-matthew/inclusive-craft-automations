<?php

use App\Models\Appointment;
use App\Models\Customer;
use Illuminate\Support\Facades\Event;

it('serves a valid ics file for the confirmation calendar link without requiring pin verification', function () {
    $customer = Customer::factory()->create();
    $appointment = Appointment::factory()->for($customer)->create([
        'scheduled_at' => '2026-03-15 14:30:00',
    ]);

    expect($this->get(route('appointments.calendar', $appointment))
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'text/calendar; charset=utf-8')
        ->getContent())
        ->toContain('BEGIN:VCALENDAR')
        ->toContain('DTSTART:20260315T143000Z')
        ->toContain('END:VCALENDAR')
        ->not->toContain('data:text/calendar');
});

it('serves a valid ics file for the reminder calendar link, titled with the customer name, without requiring pin verification', function () {
    $customer = Customer::factory()->create(['name' => 'Ann Perkins']);
    $appointment = Appointment::factory()->for($customer)->create([
        'scheduled_at' => '2026-03-15 14:30:00',
    ]);

    expect($this->get(route('appointments.reminder-calendar', $appointment))
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'text/calendar; charset=utf-8')
        ->getContent())
        ->toContain('BEGIN:VCALENDAR')
        ->toContain('SUMMARY:Visit with Ann Perkins')
        ->toContain('END:VCALENDAR')
        ->not->toContain('data:text/calendar');
});

it('serves a valid ics file for the admin calendar link, identifying the customer, without requiring pin verification', function () {
    $customer = Customer::factory()->create(['name' => 'Ann Perkins', 'email' => 'ann@example.com']);
    $appointment = Appointment::factory()->for($customer)->create([
        'scheduled_at' => '2026-03-15 14:30:00',
    ]);

    expect($this->get(route('appointments.admin-calendar', $appointment))
        ->assertSuccessful()
        ->assertHeader('Content-Type', 'text/calendar; charset=utf-8')
        ->getContent())
        ->toContain('BEGIN:VCALENDAR')
        ->toContain('SUMMARY:Appointment with Ann Perkins')
        ->toContain('Ann Perkins (ann@example.com)')
        ->toContain('END:VCALENDAR')
        ->not->toContain('data:text/calendar');
});

it('converts a british summer time appointment to utc in the ics file', function (string $routeName) {
    $appointment = Appointment::factory()->for(Customer::factory())->create([
        'scheduled_at' => '2026-07-15 14:30:00',
    ]);

    expect($this->get(route($routeName, $appointment))->assertSuccessful()->getContent())
        ->toContain('DTSTART:20260715T133000Z')
        ->toContain('DTEND:20260715T140000Z');
})->with([
    'appointments.calendar',
    'appointments.reminder-calendar',
    'appointments.admin-calendar',
]);

it('serves an ics file in utc for a british summer time appointment booked through the form', function () {
    Event::fake();

    $this->travelTo('2026-07-01 12:00:00');

    $this->withSession(['pin_verified' => true])
        ->post(route('appointments.store'), [
            'name' => 'Ann Perkins',
            'email' => 'ann@example.com',
            'scheduled_at' => '2026-07-15T14:30',
        ])
        ->assertRedirect();

    expect($this->get(route('appointments.admin-calendar', Appointment::first()))->assertSuccessful()->getContent())
        ->toContain('DTSTART:20260715T133000Z')
        ->toContain('DTEND:20260715T140000Z');
});
