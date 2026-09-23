<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointmenthistory extends Model
{

    protected $fillable = [

           'old_status',
           'new_status',
            'changed_at',
    ];
    public function Appointments():BelongsTo
    {
    return $this->belongsTo(Appointment::class);
    }
}
