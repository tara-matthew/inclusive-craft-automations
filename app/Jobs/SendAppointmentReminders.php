<?php

namespace App\Jobs;

use App\Mail\AppointmentReminder as AppointmentReminderNotification;
use App\Models\AppointmentReminder;
use App\ReminderStatus;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendAppointmentReminders implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $dueReminders = AppointmentReminder::query()
            ->where('status', ReminderStatus::UNPROCESSED)
            ->where('send_at', '<=', now())
            ->with(['appointment.customer'])
            ->get();

        Log::info('Processing appointment reminders', ['due_count' => $dueReminders->count()]);

        if ($dueReminders->isEmpty()) {
            Log::info('No appointment reminders due to be sent');

            return;
        }

        $sentCount = 0;
        $failedCount = 0;

        foreach ($dueReminders as $reminder) {
            try {
                Mail::to(config('mail.to.address'))
                    ->send(new AppointmentReminderNotification($reminder));

                $reminder->update(['status' => ReminderStatus::SENT]);
                $sentCount++;

                Log::info('Appointment reminder sent', [
                    'reminder_id' => $reminder->id,
                    'appointment_id' => $reminder->appointment->id,
                    'customer_name' => $reminder->appointment->customer->name,
                    'sent_at' => now(),
                ]);
            } catch (Exception $e) {
                $reminder->update(['status' => ReminderStatus::FAILED]);
                $failedCount++;

                Log::error('Failed to send appointment reminder', [
                    'reminder_id' => $reminder->id,
                    'appointment_id' => $reminder->appointment->id,
                    'customer_email' => $reminder->appointment->customer->email,
                    'error' => $e->getMessage(),
                    'send_at' => $reminder->send_at,
                ]);
            }
        }

        Log::info('Appointment reminder processing completed', [
            'total_processed' => $dueReminders->count(),
            'sent' => $sentCount,
            'failed' => $failedCount,
        ]);
    }
}
