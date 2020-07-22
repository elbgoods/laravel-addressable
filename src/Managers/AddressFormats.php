<?php

namespace Elbgoods\LaravelAddressable\Managers;

use Elbgoods\LaravelAddressable\AddressFormats\CzechRepublic;
use Elbgoods\LaravelAddressable\AddressFormats\Germany;
use Elbgoods\LaravelAddressable\AddressFormats\International;
use Elbgoods\LaravelAddressable\AddressFormats\Switzerland;
use Elbgoods\LaravelAddressable\AddressFormats\UnitedStatesOfAmerica;
use Elbgoods\LaravelAddressable\Contracts\AddressFormat;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;
use InvalidArgumentException;

class AddressFormats extends Manager
{
    protected const DEFAULT_DRIVER = 'international';

    protected const FORMATS = [
        self::DEFAULT_DRIVER => International::class,
        'CH' => Switzerland::class,
        'CZ' => CzechRepublic::class,
        'DE' => Germany::class,
        'US' => UnitedStatesOfAmerica::class,
    ];

    public function country(?string $country = null): AddressFormat
    {
        return $this->driver($country);
    }

    public function rules(?string $country = null, ?string $prefix = null): array
    {
        return $this->country($country)->rules($prefix);
    }

    public function fields(?string $country = null, ?string $prefix = null): array
    {
        return $this->country($country)->fields($prefix);
    }

    public function fake(string $country, array $data = []): array
    {
        return $this->country($country)->fake($country, $data);
    }

    public function getDefaultDriver(): string
    {
        return self::DEFAULT_DRIVER;
    }

    public function driver($driver = null): AddressFormat
    {
        try {
            return parent::driver($driver);
        } catch (InvalidArgumentException $exception) {
            if ($driver === self::DEFAULT_DRIVER) {
                throw $exception;
            }

            return parent::driver(self::DEFAULT_DRIVER);
        }
    }

    protected function createDriver($driver): AddressFormat
    {
        if ($driver === null) {
            $driver = self::DEFAULT_DRIVER;
        }

        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        }

        $method = 'create'.Str::studly($driver).'Driver';
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        if (array_key_exists($driver, self::FORMATS)) {
            return app(self::FORMATS[$driver]);
        }

        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }
}
