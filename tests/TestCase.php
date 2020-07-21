<?php

namespace Elbgoods\LaravelAddressable\Tests;

use Elbgoods\LaravelAddressable\AddressableServiceProvider;
use Elbgoods\LaravelAddressable\Managers\AddressFormats;
use Elbgoods\LaravelAddressable\Models\Address;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            AddressableServiceProvider::class,
        ];
    }
}
