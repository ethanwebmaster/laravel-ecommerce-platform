<?php

namespace Corals\Modules\Ecommerce\Widgets;

use Corals\Modules\Ecommerce\Classes\Wishlist;
use \Corals\Modules\Ecommerce\Models\Order;

class MyWishlistWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $Wishlist = new Wishlist();
        $wishlists = $Wishlist->getUserWishlist(user()->id)->count();
        return ' <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>' . $wishlists . '</h3>
                        <p>'.trans('Ecommerce::labels.widget.my_wishlist').'</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-heart"></i>
                    </div>
                    <a href="' . url('e-commerce/wishlist/my') . '" class="small-box-footer">
                       '.trans('Corals::labels.more_info').'
                    </a>
                </div>';
    }

}