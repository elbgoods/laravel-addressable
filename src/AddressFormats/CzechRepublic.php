<?php

namespace Elbgoods\LaravelAddressable\AddressFormats;

use Faker\Generator;

class CzechRepublic extends BaseFormat
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
                'regex:/^([0-9]{5}|[0-9]{3} [0-9]{2})$/',
            ],
            'city' => [
                'required',
                'string',
            ],
            'post_office' => [
                'required',
                'string',
            ],
        ];
    }

    protected function factory(Generator $faker): array
    {
        return [
            'country_code' => 'CZ',
            'street' => $faker->streetName,
            'house_number' => $faker->buildingNumber,
            'postal_code' => $faker->postcode,
            'city' => $faker->city,
            'post_office' => 'P.O. Box '.$faker->randomNumber(2),
        ];
    }
}
