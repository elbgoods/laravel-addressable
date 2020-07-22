<?php

namespace Elbgoods\LaravelAddressable\Tests\Managers;

use Elbgoods\LaravelAddressable\AddressFormats\Germany;
use Elbgoods\LaravelAddressable\AddressFormats\International;
use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Elbgoods\LaravelAddressable\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class AddressFormatsTest extends TestCase
{
    /** @test */
    public function international_is_default_driver(): void
    {
        $this->assertInstanceOf(
            International::class,
            AddressFormats::country()
        );
    }

    /** @test */
    public function specific_format_by_identifier(): void
    {
        $this->assertInstanceOf(
            Germany::class,
            AddressFormats::country('DE')
        );
    }

    /** @test */
    public function international_format_if_identifier_does_not_exist(): void
    {
        $this->assertInstanceOf(
            International::class,
            AddressFormats::country('foobar')
        );
    }

    /** @test */
    public function applies_prefix_to_fields_array(): void
    {
        $fields = AddressFormats::fields(null, 'address');

        $this->assertSame([
            'address.country_code',
            'address.address_line_1',
            'address.address_line_2',
            'address.postal_code',
            'address.city',
            'address.state',
        ], $fields);
    }

    /** @test */
    public function can_validate_german_address(): void
    {
        $data = [
            'name' => 'Elbgoods GmbH',
            'address' => [
                'country_code' => 'DE',
                'street' => 'Alter Wall',
                'house_number' => '69',
                'postal_code' => '20457',
                'city' => 'Hamburg',
            ],
        ];

        $validator = Validator::make($data, array_merge([
            'name' => 'required|string',
        ], AddressFormats::rules($data['address']['country_code'], 'address')));

        $this->assertFalse($validator->fails(), $validator->errors()->first());
    }
}
