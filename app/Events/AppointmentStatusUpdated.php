<?php

namespace App\Events;

use App\Models\Appointment;
use Illuminate\Broadcasting\PrivateChannel;

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AppointmentStatusUpdated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Appointment $appointment
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel(
                'appointments.' . $this->appointment->customer_id
            ),
        ];
    }

    public function broadcastAs(): string
    {
        return 'appointment.status.updated';
    }
}