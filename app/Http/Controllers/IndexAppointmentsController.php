<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class IndexAppointmentsController extends Controller
{
    public function __invoke()
    {
        $appointments = Appointment::query()
            ->with(['customer', 'appointmentReminder'])
            ->orderBy('scheduled_at')
            ->get();

        return view('appointments.index', compact('appointments'));
    }
}
