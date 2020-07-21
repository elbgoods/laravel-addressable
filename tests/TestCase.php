<?php

namespace Elbgoods\LaravelAddressable\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Elbgoods\LaravelAddressable\AddressableServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            AddressableServiceProvider::class,
        ];
    }
}
