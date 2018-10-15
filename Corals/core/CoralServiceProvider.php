<?php

namespace Corals;

use Corals\Modules\ModulesServiceProvider;
use Corals\Foundation\FoundationServiceProvider;
use Illuminate\Support\ServiceProvider;

class CoralServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(FoundationServiceProvider::class);

        //load modules last thing
        if (class_exists(ModulesServiceProvider::class)) {
            $this->app->register(ModulesServiceProvider::class);
        }
    }
}
