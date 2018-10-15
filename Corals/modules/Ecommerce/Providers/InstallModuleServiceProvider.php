<?php

namespace Corals\Modules\Ecommerce\Providers;

use Corals\Foundation\Providers\BaseInstallModuleServiceProvider;
use Corals\Modules\Ecommerce\database\migrations\CreateEcommerceTable;
use Corals\Modules\Ecommerce\database\migrations\CreateOrdersTable;
use Corals\Modules\Ecommerce\database\migrations\CreateRatingsTable;
use Corals\Modules\Ecommerce\database\migrations\CreateWishlistsTable;
use Corals\Modules\Ecommerce\database\seeds\EcommerceDatabaseSeeder;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $migrations = [
        CreateRatingsTable::class,
        CreateEcommerceTable::class,
        CreateOrdersTable::class,
        CreateWishlistsTable::class,
    ];

    protected $module_public_path = __DIR__ . '/../public';

    protected function booted()
    {
        $this->createSchema();

        $ecommerceSeeder = new EcommerceDatabaseSeeder();
        $ecommerceSeeder->run();
    }
}
