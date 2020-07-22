<?php

namespace Elbgoods\LaravelAddressable\AddressFormats;

use Faker\Generator;

class Germany extends BaseFormat
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
                'regex:/^[0-9]{5}$/',
            ],
            'city' => [
                'required',
                'string',
            ],
        ];
    }

    protected function factory(Generator $faker): array
    {
        return [
            'country_code' => 'DE',
            'street' => $faker->streetName,
            'house_number' => $faker->buildingNumber,
            'postal_code' => $faker->postcode,
            'city' => $faker->city,
        ];
    }
}
