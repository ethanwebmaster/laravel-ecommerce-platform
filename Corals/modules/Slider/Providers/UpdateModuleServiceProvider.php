<?php

namespace Corals\Modules\Slider\Providers;

use Corals\Foundation\Providers\BaseUpdateModuleServiceProvider;

class UpdateModuleServiceProvider extends BaseUpdateModuleServiceProvider
{
    protected $module_code = 'corals-cms-slider';
    protected $batches_path = __DIR__ . '/../update-batches/*.php';
}
