<?php

use App\Jobs\SendAppointmentReminders;
use App\Models\Appointment;
use App\Models\AppointmentReminder;
use App\Models\Customer;
use App\ReminderStatus;
use Illuminate\Support\Facades\Mail;

it('sends due appointment reminders', function () {
    Mail::fake();

    $customer = Customer::factory()->create();
    $appointment = Appointment::factory()->for($customer)->create();

    $dueReminder = AppointmentReminder::factory()
        ->unprocessed()
        ->for($appointment)
        ->create([
            'send_at' => now(),
        ]);

    AppointmentReminder::factory()->unprocessed()
        ->for($appointment)
        ->create([
            'send_at' => now()->addDay(),
        ]);

    AppointmentReminder::factory()
        ->unprocessed()
        ->sent()
        ->for($appointment)
        ->create([
            'send_at' => now()->subDay(),
        ]);

    SendAppointmentReminders::dispatch();

    $this->assertDatabaseHas('appointment_reminders', [
        'id' => $dueReminder->id,
        'status' => ReminderStatus::SENT,
    ]);

    Mail::assertQueued(\App\Mail\AppointmentReminder::class, config('mail.to.address'));
    Mail::assertQueuedCount(1);
});

it('handles case when no reminders are due', function () {
    Mail::fake();

    $customer = Customer::factory()->create();
    $appointment = Appointment::factory()->for($customer);

    $notDueReminder = AppointmentReminder::factory()
        ->unprocessed()
        ->for($appointment)
        ->create([
            'send_at' => now()->addDay(),
        ]);

    SendAppointmentReminders::dispatch();

    $this->assertDatabaseHas('appointment_reminders', [
        'id' => $notDueReminder->id,
        'status' => ReminderStatus::UNPROCESSED,
    ]);

    Mail::assertNothingQueued();
});

it('processes multiple due reminders', function () {
    Mail::fake();

    $customer = Customer::factory()->create();
    $customerTwo = Customer::factory()->create();

    $appointment = Appointment::factory()->for($customer)->create();
    $appointmentTwo = Appointment::factory()->for($customerTwo)->create();

    $dueReminderForCustomer = AppointmentReminder::factory()
        ->unprocessed()
        ->for($appointment)
        ->create([
            'send_at' => now(),
        ]);

    $dueReminderForCustomerTwo = AppointmentReminder::factory()
        ->unprocessed()
        ->for($appointmentTwo)
        ->create([
            'send_at' => now(),
        ]);

    SendAppointmentReminders::dispatch();

    $this->assertDatabaseHas('appointment_reminders', [
        'id' => $dueReminderForCustomer->id,
        'status' => ReminderStatus::SENT,
    ]);

    $this->assertDatabaseHas('appointment_reminders', [
        'id' => $dueReminderForCustomerTwo->id,
        'status' => ReminderStatus::SENT,
    ]);

    Mail::assertQueued(\App\Mail\AppointmentReminder::class, config('mail.to.address'));
    Mail::assertQueuedCount(2);
});
