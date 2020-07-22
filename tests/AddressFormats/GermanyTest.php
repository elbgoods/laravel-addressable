<?php

namespace Elbgoods\LaravelAddressable\Tests\AddressFormats;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Elbgoods\LaravelAddressable\Tests\TestCase;
use Illuminate\Support\Facades\Validator;

final class GermanyTest extends BaseFormatTest
{
    /**
     * @test
     * @dataProvider repeatTest
     */
    public function faked_address_passes_validation_rules(): void
    {
        $data = AddressFormats::fake('DE');

        $validator = Validator::make($data, AddressFormats::rules('DE'));

        $this->assertFalse($validator->fails(), $validator->errors()->first());
    }
}
