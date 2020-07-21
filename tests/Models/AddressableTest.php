<?php

namespace Elbgoods\LaravelAddressable\Tests\Models;

use Elbgoods\LaravelAddressable\Models\Address;
use Elbgoods\LaravelAddressable\Tests\TestCase;
use Elbgoods\LaravelAddressable\Tests\Utils\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class AddressableTest extends TestCase
{
    /** @test */
    public function it_has_an_address(): void
    {
        $company = Company::create([
            'name' => 'Elbgoods GmbH',
            'address' => [
                'country_code' => 'DE',
                'street' => 'Alter Wall',
                'house_number' => '69',
                'postal_code' => '20457',
                'city' => 'Hamburg',
            ],
        ]);

        $company->address->city = 'Berlin';

        dump($company->toArray(), $company->address->toArray());
        dump(
            $company->address->country_code,
            $company->address->city
        );
    }
}
