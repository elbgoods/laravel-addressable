<?php

namespace Elbgoods\LaravelAddressable\Managers;

use Elbgoods\LaravelAddressable\AddressFormats\Germany;
use Elbgoods\LaravelAddressable\AddressFormats\International;
use Elbgoods\LaravelAddressable\Contracts\AddressFormat;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;
use InvalidArgumentException;

class AddressFormats extends Manager
{
    protected const DEFAULT_DRIVER = 'international';

    protected const FORMATTERS = [
        'international' => International::class,
        'de' => Germany::class,
    ];

    public function country(?string $country = null): AddressFormat
    {
        if($country === null) {
            $country = self::DEFAULT_DRIVER;
        }

        $country = strtolower($country);

        try {
            return $this->driver($country);
        } catch(InvalidArgumentException $exception) {
            if($country === self::DEFAULT_DRIVER) {
                throw $exception;
            }

            return $this->driver(self::DEFAULT_DRIVER);
        }
    }

    public function getDefaultDriver()
    {
        return self::DEFAULT_DRIVER;
    }

    protected function createDriver($driver): AddressFormat
    {
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        }

        $method = 'create'.Str::studly($driver).'Driver';
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        if (array_key_exists($driver, self::FORMATTERS)) {
            return app(self::FORMATTERS[$driver]);
        }

        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }
}
