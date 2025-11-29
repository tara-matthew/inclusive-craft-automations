<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\AppointmentReminder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AppointmentReminder>
 */
class AppointmentReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'send_at' => function (array $attributes) {
                return Appointment::find($attributes['appointment_id'])->scheduled_at->subDays(1);
            },
        ];
    }
}
