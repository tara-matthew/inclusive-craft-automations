<?php

namespace App\Models;

use App\ReminderStatus;
use Database\Factories\AppointmentReminderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentReminder extends Model
{
    /** @use HasFactory<AppointmentReminderFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'send_at' => 'datetime',
            'status' => ReminderStatus::class,
        ];
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
