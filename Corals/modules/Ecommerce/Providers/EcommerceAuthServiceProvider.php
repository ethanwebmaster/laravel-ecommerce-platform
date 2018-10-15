<?php

namespace Corals\Modules\Ecommerce\Providers;

use Corals\Modules\Ecommerce\Models\Product;
use Corals\Modules\Ecommerce\Models\SKU;
use Corals\Modules\Ecommerce\Policies\ProductPolicy;
use Corals\Modules\Ecommerce\Policies\RatingPolicy;
use Corals\Modules\Ecommerce\Policies\SKUPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Trexology\ReviewRateable\Models\Rating;

class EcommerceAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        SKU::class => SKUPolicy::class,
        Rating::class => RatingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}