<?php

namespace App\Models;

use Database\Factories\AppointmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\CalendarLinks\Link;

class Appointment extends Model
{
    /** @use HasFactory<AppointmentFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function appointmentReminder(): HasOne
    {
        return $this->hasOne(AppointmentReminder::class);
    }

    public function customerCalendarLink(): Link
    {
        return Link::create(
            'Inclusive Craft Co. Appointment',
            $this->scheduled_at,
            $this->scheduled_at->addMinutes(30),
        )->description('Your appointment with Inclusive Craft Co.');
    }

    public function reminderCalendarLink(): Link
    {
        return Link::create(
            "Visit with {$this->customer->name}",
            $this->scheduled_at,
            $this->scheduled_at->addMinutes(30),
        )->description("Visit with {$this->customer->name} at Inclusive Craft Co.");
    }
}
