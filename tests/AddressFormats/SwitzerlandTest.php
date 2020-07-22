<?php

namespace Elbgoods\LaravelAddressable\Tests\AddressFormats;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Elbgoods\LaravelAddressable\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class SwitzerlandTest extends BaseFormatTest
{
    /**
     * @test
     * @dataProvider repeatTest
     */
    public function faked_address_passes_validation_rules(): void
    {
        $data = AddressFormats::fake('CH');

        $validator = Validator::make($data, AddressFormats::rules('CH'));

        $this->assertFalse($validator->fails(), $validator->errors()->first());
    }
}
