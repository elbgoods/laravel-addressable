<?php

namespace Elbgoods\LaravelAddressable\Tests\Managers;

use Elbgoods\LaravelAddressable\AddressFormats\Germany;
use Elbgoods\LaravelAddressable\AddressFormats\International;
use Elbgoods\LaravelAddressable\Contracts\AddressFormat;
use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Elbgoods\LaravelAddressable\Managers\AddressFormats as AddressFormatsManager;
use Elbgoods\LaravelAddressable\Tests\TestCase;

final class AddressFormatsTest extends TestCase
{
    /** @test */
    public function can_instantiate_manager(): void
    {
        $this->assertInstanceOf(
            AddressFormatsManager::class,
            $this->app->make(AddressFormatsManager::class)
        );
    }

    /** @test */
    public function can_use_facade(): void
    {
        $this->assertInstanceOf(
            AddressFormat::class,
            AddressFormats::country()
        );
    }

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
            AddressFormats::country('de')
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
        $fields = AddressFormats::country()->fields('address');

        $this->assertSame([
            'address.country_code',
            'address.address_line_1',
            'address.address_line_2',
            'address.postal_code',
            'address.city',
            'address.state',
        ], $fields);
    }
}
