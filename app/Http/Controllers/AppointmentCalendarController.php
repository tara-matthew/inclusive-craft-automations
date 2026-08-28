<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Response;
use Spatie\CalendarLinks\Generators\Ics;

class AppointmentCalendarController extends Controller
{
    public function __invoke(Appointment $appointment): Response
    {
        $ics = $appointment->customerCalendarLink()->ics([], ['format' => Ics::FORMAT_FILE]);

        return response($ics, 200, [
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="appointment.ics"',
        ]);
    }
}
