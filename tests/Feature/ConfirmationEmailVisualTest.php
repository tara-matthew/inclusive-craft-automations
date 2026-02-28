<?php

use App\Models\Appointment;

it('renders correctly on desktop', function () {
    $this->travelTo('2026-02-28 10:00:00');
    $appointment = Appointment::factory()->create([
        'scheduled_at' => now()->addDays(2),
    ]);

    visit("/emails/confirmation-preview/{$appointment->id}")
        ->assertScreenshotMatches();
});

it('renders correctly on mobile', function () {
    $this->travelTo('2026-02-28 10:00:00');

    $appointment = Appointment::factory()->create([
        'scheduled_at' => now()->addDays(12),
    ]);

    visit("/emails/confirmation-preview/{$appointment->id}")
        ->on()->mobile()
        ->assertScreenshotMatches();
});


