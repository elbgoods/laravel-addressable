<?php

namespace Elbgoods\LaravelAddressable\Tests\AddressFormats;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Illuminate\Support\Facades\Validator;

final class UnitedStatesOfAmericaTest extends BaseFormatTest
{
    /**
     * @test
     * @dataProvider repeatTest
     */
    public function faked_address_passes_validation_rules(): void
    {
        $data = AddressFormats::fake('US');

        $validator = Validator::make($data, AddressFormats::rules('US'));

        $this->assertFalse($validator->fails(), $validator->errors()->first());
    }
}
