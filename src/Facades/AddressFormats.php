<?php

namespace Elbgoods\LaravelAddressable\Facades;

use Elbgoods\LaravelAddressable\Contracts\AddressFormat;
use Elbgoods\LaravelAddressable\Managers\AddressFormats as AddressFormatsManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static AddressFormat country(?string $country = null)
 * @method static array fields(?string $country = null, ?string $prefix = null)
 * @method static array rules(?string $country = null, ?string $prefix = null)
 * @method static array fake(string $country, array $data = [])
 *
 * @see \Elbgoods\LaravelAddressable\Managers\AddressFormats
 */
class AddressFormats extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AddressFormatsManager::class;
    }
}
