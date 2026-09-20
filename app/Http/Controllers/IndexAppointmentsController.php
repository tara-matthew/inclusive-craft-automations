<?php

namespace App\Http\Controllers;

use App\AppointmentStatus;
use App\Models\Appointment;
use Illuminate\Http\Request;

class IndexAppointmentsController extends Controller
{
    public function __invoke(Request $request)
    {
        $status = AppointmentStatus::tryFrom((string) $request->query('status')) ?? AppointmentStatus::UPCOMING;

        $appointments = Appointment::query()
            ->with(['customer', 'appointmentReminder'])
            ->when($status === AppointmentStatus::PAST, fn ($query) => $query->where('scheduled_at', '<', now()))
            ->when($status === AppointmentStatus::UPCOMING, fn ($query) => $query->where('scheduled_at', '>=', now()))
            ->orderBy('scheduled_at', $status === AppointmentStatus::PAST ? 'desc' : 'asc')
            ->get();

        return view('appointments.index', compact('appointments', 'status'));
    }
}
