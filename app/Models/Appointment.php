<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    protected $fillable = [
        'service_id',
        'provider_id',
        'customer_id',
        'status',
        'booking_date',
        'booking_time',
          'reminder_sent_at',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(AppointmentHistory::class);
    }
}