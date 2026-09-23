<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('appointments.{customerId}', function ($user, $customerId) {
    return (int) $user->id === (int) $customerId;
});
