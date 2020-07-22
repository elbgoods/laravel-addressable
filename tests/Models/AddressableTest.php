<?php

namespace Elbgoods\LaravelAddressable\Tests\Models;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Elbgoods\LaravelAddressable\Models\Address;
use Elbgoods\LaravelAddressable\Tests\TestCase;
use Elbgoods\LaravelAddressable\Tests\Utils\Company;

final class AddressableTest extends TestCase
{
    /** @test */
    public function it_can_fill_address_as_attribute(): void
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

        $this->assertTrue($company->exists);
        $this->assertSame(1, Company::count());
        $this->assertTrue($company->address->exists);
        $this->assertSame(1, Address::count());

        $this->assertSame('Elbgoods GmbH', $company->name);
        $this->assertSame('DE', $company->address->country_code);
        $this->assertSame('Alter Wall', $company->address->street);
        $this->assertSame('69', $company->address->house_number);
        $this->assertSame('20457', $company->address->postal_code);
        $this->assertSame('Hamburg', $company->address->city);
    }

    /** @test */
    public function it_can_set_properties_as_attributes(): void
    {
        $company = Company::create([
            'name' => 'Elbgoods GmbH',
            'address' => [
                'country_code' => 'DE',
                'street' => 'Alter Wall',
                'house_number' => '69',
                'postal_code' => '20457',
                'city' => 'HH',
            ],
        ]);

        $this->assertSame('HH', $company->address->city);

        $company->address->update([
            'city' => 'Hamburg',
        ]);

        $this->assertTrue($company->exists);
        $this->assertSame(1, Company::count());
        $this->assertTrue($company->address->exists);
        $this->assertSame(1, Address::count());

        $this->assertSame('DE', $company->address->country_code);
        $this->assertSame('Alter Wall', $company->address->street);
        $this->assertSame('69', $company->address->house_number);
        $this->assertSame('20457', $company->address->postal_code);
        $this->assertSame('Hamburg', $company->address->city);
    }

    /** @test */
    public function it_can_override_whole_address_without_creating_a_new_one(): void
    {
        $company = Company::create([
            'name' => 'Elbgoods GmbH',
            'address' => AddressFormats::fake('US'),
        ]);

        $this->assertTrue($company->exists);
        $this->assertSame(1, Company::count());
        $this->assertTrue($company->address->exists);
        $this->assertSame(1, Address::count());

        $company->update([
            'address' => [
                'country_code' => 'DE',
                'street' => 'Alter Wall',
                'house_number' => '69',
                'postal_code' => '20457',
                'city' => 'Hamburg',
            ],
        ]);

        $this->assertSame('Elbgoods GmbH', $company->name);
        $this->assertSame('DE', $company->address->country_code);
        $this->assertSame('Alter Wall', $company->address->street);
        $this->assertSame('69', $company->address->house_number);
        $this->assertSame('20457', $company->address->postal_code);
        $this->assertSame('Hamburg', $company->address->city);
    }

    /** @test */
    public function it_moves_all_properties_to_top_level_on_array(): void
    {
        $data = [
            'country_code' => 'DE',
            'street' => 'Alter Wall',
            'house_number' => '69',
            'postal_code' => '20457',
            'city' => 'Hamburg',
        ];

        $company = Company::create([
            'name' => 'Elbgoods GmbH',
            'address' => $data,
        ]);

        $attributes = $company->address->toArray();
        foreach ($data as $attribute => $value) {
            $this->assertArrayHasKey($attribute, $attributes);
            $this->assertSame($value, $attributes[$attribute]);
        }
    }
}
