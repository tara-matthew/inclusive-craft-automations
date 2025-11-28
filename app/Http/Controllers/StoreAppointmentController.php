<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Customer;
use Illuminate\Http\Request;

class StoreAppointmentController extends Controller
{
    public function __invoke(StoreAppointmentRequest $request)
    {
        $validated = $request->validated();

        $customer = Customer::create([
            'name' => $validated['name'],
            'secondary_name' => $validated['secondary_name'] ?? null,
            'email' => $validated['email'],
        ]);

        $appointment = new Appointment([
            'scheduled_at' => $validated['scheduled_at'],
        ]);

        $appointment->customer()->associate($customer);
        $appointment->save();
    }
}
