<?php

namespace Elbgoods\LaravelAddressable\Tests;

use CreateAddressesTable;
use Elbgoods\LaravelAddressable\AddressableServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            AddressableServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->createTables();
    }

    protected function createTables(): void
    {
        include_once __DIR__.'/../migrations/create_addresses_table.php.stub';

        (new CreateAddressesTable())->up();

        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }
}
