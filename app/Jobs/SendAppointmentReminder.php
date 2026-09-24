<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Notifications\AppointmentReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
class SendAppointmentReminder implements ShouldQueue
{
     
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
     
        $upcomingFrom = now()->subMinutes(5)->toDateTimeString();
        $upcomingTo   = now()->addMinutes(30)->toDateTimeString();

        $appointments = Appointment::with('customer')
            ->where('status', 'confirmed')
            ->whereNull('reminder_sent_at')
            ->whereRaw("TIMESTAMP(booking_date, booking_time) BETWEEN ? AND ?", [
                $upcomingFrom,
                $upcomingTo,
            ])
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->customer->notify(
                new AppointmentReminder($appointment)
            );

            $appointment->update([
                'reminder_sent_at' => now(),
            ]);
        }
    }
}