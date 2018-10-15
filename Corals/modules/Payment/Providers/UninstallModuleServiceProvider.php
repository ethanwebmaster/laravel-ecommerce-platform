<?php

namespace Corals\Modules\Payment\Providers;

use Corals\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Corals\Modules\Payment\Common\database\migrations\CreateTaxablesTable;
use Corals\Modules\Payment\Common\database\migrations\CreateTaxClassesTable;
use Corals\Modules\Payment\Common\database\migrations\CreateTaxesTable;
use Corals\Modules\Payment\Common\database\seeds\PaymentDatabaseSeeder;
use Corals\Modules\Payment\database\migrations\CreateCurrencyTable;
use Corals\Modules\Payment\database\migrations\CreateGatewayStatusTable;
use Corals\Modules\Payment\database\migrations\CreateInvoicesTable;
use Corals\Modules\Payment\database\migrations\CreateWebhookCallsTable;
use Corals\Settings\Models\Module;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{

    protected $migrations = [
        CreateInvoicesTable::class,
        CreateWebhookCallsTable::class,
        CreateGatewayStatusTable::class,
        CreateTaxClassesTable::class,
        CreateTaxesTable::class,
        CreateTaxablesTable::class,
        CreateCurrencyTable::class
    ];

    protected function booted()
    {
        $this->dropSchema();

        $modules = \Modules::getPathFolders(__DIR__ . '/../');

        foreach ($modules as $row) {
            $file = $row . '/module.json';
            $data = json_decode(\Modules::getFileData($file), true);

            if ($data === null || !is_array($data)) {
                continue;
            }

            $code = array_get($data, 'code');
            try {
                \Modules::uninstall($code);
            } catch (\Exception $exception) {

            }
        }

        $module = Module::where('code', 'corals-ecommerce')->first();
        if ($module && $module->installed) {
            \Modules::uninstall($module);
        }

        $module = Module::where('code', 'corals-subscriptions')->first();
        if ($module && $module->installed) {
            \Modules::uninstall($module);
        }

        $paymentDatabaseSeeder = new PaymentDatabaseSeeder();
        $paymentDatabaseSeeder->rollback();
    }
}
