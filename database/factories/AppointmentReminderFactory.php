<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\AppointmentReminder;
use App\ReminderStatus;
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
                return Appointment::find($attributes['appointment_id'])->scheduled_at->subDays(1)->setTime(8, 0);
            },
            'status' => ReminderStatus::UNPROCESSED,
        ];
    }

    public function unprocessed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => ReminderStatus::UNPROCESSED,
            ];
        });
    }

    public function sent(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => ReminderStatus::SENT,
            ];
        });
    }

    /**
     * Create a failed appointment reminder.
     */
    public function failed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => ReminderStatus::FAILED,
            ];
        });
    }
}
