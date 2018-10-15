<?php

namespace Corals\Modules\Ecommerce\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class WishlistPresenter extends FractalPresenter
{

    /**
     * @return CategoryTransformer
     */
    public function getTransformer()
    {
        return new WishlistTransformer();
    }
}