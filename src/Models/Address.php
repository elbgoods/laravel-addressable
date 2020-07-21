<?php

namespace Elbgoods\LaravelAddressable\Models;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;

final class Address extends Model
{
    protected $fillable = [
        'country_code',
        'properties',
    ];

    protected $casts = [
        'addressable_id' => 'int',
        'properties' => 'array',
    ];

    public static function fromArray(array $data): self
    {
        return new static([
            'country_code' => $data['country_code'],
            'properties' => Arr::except(
                Arr::only($data, AddressFormats::country($data['country_code'])->fields()),
                'country_code'
            ),
        ]);
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getPropertiesAttribute($value): array
    {
        if(empty($value)) {
            return [];
        }

        return $this->fromJson($value, false) ?? [];
    }

    public function setPropertiesAttribute($value): void
    {
        if(empty($value)) {
            $this->attributes['properties'] = $this->asJson([]);

            return;
        }

        $this->attributes['properties'] = $this->asJson($value);
    }

    public function getAttribute($key)
    {
        if($this->isFillableProperty($key)) {
            return $this->getAttribute('properties')[$key] ?? null;
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if($this->isFillableProperty($key)) {
            $properties = $this->getAttribute('properties');
            $properties[$key] = $value;
            $this->setAttribute('properties', $properties);

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    public function isFillableProperty(string $key): bool
    {
        if(in_array($key, array_keys($this->getAttributes()))) {
            return false;
        }

        if(!array_key_exists('country_code', $this->attributes)) {
            return false;
        }

        return in_array($key, AddressFormats::country($this->getAttribute('country_code'))->fields());
    }
}
