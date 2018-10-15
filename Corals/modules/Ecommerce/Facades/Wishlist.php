<?php

namespace Corals\Modules\Ecommerce\Facades;

use Illuminate\Support\Facades\Facade;
use Corals\Modules\Ecommerce\Classes\Wishlist as WishlistClass;

class Wishlist extends Facade
{

    protected static function getFacadeAccessor()
    {
        return WishlistClass::class;
    }

}