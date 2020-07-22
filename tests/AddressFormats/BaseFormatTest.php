<?php

namespace Elbgoods\LaravelAddressable\Tests\AddressFormats;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Elbgoods\LaravelAddressable\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

abstract class BaseFormatTest extends TestCase
{
    public final function repeatTest()
    {
        for ($i = 0; $i < 100; $i++) {
            yield [];
        }
    }
}
