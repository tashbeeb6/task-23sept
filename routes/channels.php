<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('appointments.{customerId}', function ($user, $customerId) {
    return (int) $user->id === (int) $customerId;
});
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});