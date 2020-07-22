<?php

namespace Elbgoods\LaravelAddressable\AddressFormats;

use Faker\Generator;

class UnitedStatesOfAmerica extends BaseFormat
{
    protected function formatConfig(): array
    {
        return [
            'street' => [
                'required',
                'string',
            ],
            'house_number' => [
                'required',
                'string',
            ],
            'postal_code' => [
                'required',
                'string',
                'regex:/^[0-9]{5}(|-[0-9]{4})$/',
            ],
            'city' => [
                'required',
                'string',
            ],
            'state' => [
                'required',
                'string',
                'regex:/^[A-Z]{2}$/',
            ],
        ];
    }

    protected function factory(Generator $faker): array
    {
        return [
            'country_code' => 'US',
            'street' => $faker->streetName,
            'house_number' => $faker->buildingNumber,
            'postal_code' => $faker->postcode,
            'city' => $faker->city,
            'state' => $faker->stateAbbr,
        ];
    }
}
