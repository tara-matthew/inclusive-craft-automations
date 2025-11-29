<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\AppointmentReminder;
use App\Models\Customer;
use App\ReminderStatus;

class StoreAppointmentController extends Controller
{
    public function __invoke(StoreAppointmentRequest $request)
    {
        // TODO use a transaction
        $validated = $request->validated();

        $customer = Customer::firstOrCreate([
            'name' => $validated['name'],
            'secondary_name' => $validated['secondary_name'] ?? null,
            'email' => $validated['email'],
        ]);

        $appointment = new Appointment([
            'scheduled_at' => $validated['scheduled_at'],
        ]);

        $appointment->customer()->associate($customer)->save();

        $appointmentReminder = new AppointmentReminder([
            'send_at' => $appointment->scheduled_at->subDays(1),
            'status' => ReminderStatus::UNPROCESSED,
        ]);

        $appointmentReminder->appointment()->associate($appointment)->save();

        // create appointment reminders action

        return new AppointmentResource($appointment);
    }
}
