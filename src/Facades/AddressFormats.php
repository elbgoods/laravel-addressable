<?php

namespace Elbgoods\LaravelAddressable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Elbgoods\LaravelAddressable\Contracts\AddressFormat country(?string $country = null)
 *
 * @see \Elbgoods\LaravelAddressable\Managers\AddressFormats
 */
class AddressFormats extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Elbgoods\LaravelAddressable\Managers\AddressFormats::class;
    }
}
