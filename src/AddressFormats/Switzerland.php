<?php

namespace Elbgoods\LaravelAddressable\AddressFormats;

use Elbgoods\SwissCantonRule\Rules\SwissCantonAbbreviationRule;
use Elbgoods\SwissCantonRule\Rules\SwissCantonZipCodeRule;
use Faker\Generator;
use Illuminate\Support\Arr;
use Wnx\SwissCantons\Cantons;
use Wnx\SwissCantons\ZipcodeSearch;

class Switzerland extends BaseFormat
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
                new SwissCantonZipCodeRule(),
            ],
            'city' => [
                'required',
                'string',
            ],
            'canton' => [
                'required',
                'string',
                new SwissCantonAbbreviationRule(),
            ],
        ];
    }

    protected function factory(Generator $faker): array
    {
        return [
            'country_code' => 'CH',
            'street' => $faker->streetName,
            'house_number' => $faker->buildingNumber,
            'postal_code' => strval(Arr::random(array_column((new ZipcodeSearch)->getDataSet(), 'zipcode'))),
            'city' => $faker->city,
            'canton' => Arr::random(array_keys((new Cantons)->getAllAsArray())),
        ];
    }
}
