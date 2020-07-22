<?php

namespace Elbgoods\LaravelAddressable\Tests\AddressFormats;

use Elbgoods\LaravelAddressable\Tests\TestCase;

abstract class BaseFormatTest extends TestCase
{
    final public function repeatTest()
    {
        for ($i = 0; $i < 100; $i++) {
            yield [];
        }
    }
}
