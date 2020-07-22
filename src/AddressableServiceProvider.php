<?php

namespace Elbgoods\LaravelAddressable;

use Elbgoods\LaravelAddressable\Facades\AddressFormats;
use Illuminate\Support\ServiceProvider;

class AddressableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateAddressesTable')) {
                $timestamp = date('Y_m_d_His', time());

                $this->publishes([
                    __DIR__.'/../migrations/create_addresses_table.php.stub' => database_path("/migrations/{$timestamp}_create_activity_log_table.php"),
                ], 'migrations');
            }
        }
    }

    public function register(): void
    {
        $this->app->singleton(AddressFormats::class);
    }
}
