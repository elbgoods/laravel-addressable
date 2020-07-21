<?php

namespace Elbgoods\LaravelAddressable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    protected $fillable = [
        'format',
        'properties',
        'country_code',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
