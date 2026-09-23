<?php

use App\Models\Appointment;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\User;

it('allows updating an existing appointment with its current booking date', function () {
    $user = User::factory()->create([
        'role' => 'customer',
    ]);

    $provider = ServiceProvider::create([
        'name' => 'Test Provider',
        'Contact' => '123456789',
    ]);

    $service = Service::create([
        'provider_id' => $provider->id,
        'Service_name' => 'Haircut',
        'price' => 100.00,
        'duration' => 60,
    ]);

    $appointment = Appointment::create([
        'service_id' => $service->id,
        'provider_id' => $provider->id,
        'customer_id' => $user->id,
        'status' => 'pending',
        'booking_date' => '2025-01-01',
        'booking_time' => '10:30',
    ]);

    $this->actingAs($user)
        ->put(route('appointments.update', $appointment->id), [
            'service_id' => $service->id,
            'provider_id' => $provider->id,
            'booking_date' => '2025-01-01',
            'booking_time' => '10:30',
            'status' => 'confirmed',
        ])
        ->assertRedirect(route('dashboard'));

    $appointment->refresh();
    expect($appointment->status)->toBe('confirmed');
});
