<?php

namespace Elbgoods\LaravelAddressable\AddressFormats;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Arr;

class International extends BaseFormat
{
    protected function formatConfig(): array
    {
        return [
            'address_line_1' => [
                'required',
                'string',
            ],
            'address_line_2' => [
                'nullable',
                'string',
            ],
            'postal_code' => [
                'required',
                'string',
            ],
            'city' => [
                'required',
                'string',
            ],
            'state' => [
                'nullable',
                'string',
            ],
        ];
    }

    protected function factory(Generator $faker): array
    {
        return [
            'address_line_1' => $faker->streetAddress,
            'address_line_2' => $faker->secondaryAddress,
            'postal_code' => $faker->postcode,
            'city' => $faker->city,
            'state' => $faker->state,
        ];
    }
}
