<?php

namespace App\Http\Controllers;

use App\Events\AppointmentCreated;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentReminder;
use App\Models\Customer;
use App\ReminderStatus;
use Illuminate\Support\Facades\DB;

class StoreAppointmentController extends Controller
{
    public function __invoke(StoreAppointmentRequest $request)
    {
        $validated = $request->validated();

        $appointment = DB::transaction(function () use ($validated) {
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

            return $appointment;
        });

        AppointmentCreated::dispatch($appointment);

        return back()->with('status', 'Appointment booked!');
    }
}
