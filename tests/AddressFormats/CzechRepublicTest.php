<?php

namespace Elbgoods\LaravelAddressable\Tests\AddressFormats;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Illuminate\Support\Facades\Validator;

final class CzechRepublicTest extends BaseFormatTest
{
    /**
     * @test
     * @dataProvider repeatTest
     */
    public function faked_address_passes_validation_rules(): void
    {
        $data = AddressFormats::fake('CZ');

        $validator = Validator::make($data, AddressFormats::rules('CZ'));

        $this->assertFalse($validator->fails(), $validator->errors()->first());
    }
}
