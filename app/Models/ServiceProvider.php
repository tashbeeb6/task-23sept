<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceProvider extends Model
{
    protected  $fillable = [
        'name',
        'Contact',
    ];

    public function services() :HasMany
    {
        return $this->hasMany(Service::class);
    }
}
