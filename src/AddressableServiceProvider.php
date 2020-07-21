<?php

namespace Elbgoods\LaravelAddressable;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AddressableServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->singleton(AddressFormats::class);
    }
}
