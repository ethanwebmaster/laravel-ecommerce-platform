<?php

namespace Corals\Foundation\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class CoralsForm extends IlluminateFacade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor()
    {
        return new \Corals\Foundation\Classes\CoralsForm();
    }
}
