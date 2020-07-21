<?php

namespace Elbgoods\LaravelAddressable\AddressFormats;

use Elbgoods\CountryRule\Rules\CountryAlpha2Rule;
use Elbgoods\LaravelAddressable\Contracts\AddressFormat;
use Illuminate\Support\Str;

abstract class BaseFormat implements AddressFormat
{
    public function fields(?string $prefix = null): array
    {
        return array_keys($this->rules($prefix));
    }

    public function rules(?string $prefix = null): array
    {
        $rules = array_merge([
            'country_code' => [
                'required',
                'string',
                new CountryAlpha2Rule(),
            ],
        ], $this->formatConfig());

        return $this->applyPrefix($prefix, $rules);
    }

    abstract protected function formatConfig(): array;

    protected function applyPrefix(?string $prefix, array $array): array
    {
        if(empty($prefix)) {
            return $array;
        }

        return collect($array)
            ->mapWithKeys(fn($value, $key): array => [
                Str::finish($prefix, '.').$key => $value,
            ])
            ->all();
    }
}
