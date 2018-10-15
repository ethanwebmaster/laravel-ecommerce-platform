<?php

namespace Corals\Modules\CMS\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class TagPresenter extends FractalPresenter
{

    /**
     * @return TagTransformer
     */
    public function getTransformer()
    {
        return new TagTransformer();
    }
}