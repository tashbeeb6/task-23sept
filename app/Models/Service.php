<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
protected $fillable = [
    'Service_name',
           'price',
            'duration',
];
public function ServiceProvider() : HasMany {
    return $this->hasMany(ServiceProvider::class);
}
public function Appointment() :HasMany{
    return $this->hasMany(Appointment::class);
}
}
