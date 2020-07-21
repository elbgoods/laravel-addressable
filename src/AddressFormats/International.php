<?php

namespace Elbgoods\LaravelAddressable\AddressFormats;

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
}
