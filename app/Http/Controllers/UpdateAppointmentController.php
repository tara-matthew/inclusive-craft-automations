<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\ReminderStatus;
use Illuminate\Support\Facades\DB;

class UpdateAppointmentController extends Controller
{
    public function __invoke(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($appointment, $validated) {
            $appointment->update([
                'scheduled_at' => $validated['scheduled_at'],
            ]);

            $appointment->appointmentReminder->update([
                'send_at' => $appointment->scheduled_at->subDay()->setTime(8, 0),
                'status' => ReminderStatus::UNPROCESSED,
            ]);
        });

        return back()->with('status', 'Appointment updated!');
    }
}
