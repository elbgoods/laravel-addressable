<?php

namespace Elbgoods\LaravelAddressable\Tests;

use Elbgoods\LaravelAddressable\AddressableServiceProvider;
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
