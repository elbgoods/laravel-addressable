<?php

namespace Elbgoods\LaravelAddressable\Models;

use Carbon\Carbon;
use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;

/**
 * @property int $id
 * @property string $addressable_type
 * @property int $addressable_id
 * @property string $country_code
 * @property array $properties
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Model $addressable
 */
final class Address extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    protected $casts = [
        'addressable_id' => 'int',
        'properties' => 'array',
    ];

    protected static function booted()
    {
        self::saving(function(Address $address): void {
            $address->properties = Arr::only($address->properties, AddressFormats::fields($address->country_code));
        });
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getAttribute($key)
    {
        if ($this->isFillableProperty($key)) {
            return $this->getAttribute('properties')[$key] ?? null;
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if ($this->isFillableProperty($key)) {
            $properties = $this->getAttribute('properties');
            $properties[$key] = $value;
            $this->setAttribute('properties', $properties);

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    public function isFillableProperty(string $key): bool
    {
        if(in_array($key, [
            'id',
            'country_code',
            'properties',
            'addressable_type',
            'addressable_id',
            'updated_at',
            'created_at',
        ])) {
            return false;
        }

        if (! array_key_exists('country_code', $this->getAttributes())) {
            return false;
        }

        return true;
    }
}
