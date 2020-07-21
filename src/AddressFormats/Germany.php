<?php

namespace Elbgoods\LaravelAddressable\AddressFormats;

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
}
