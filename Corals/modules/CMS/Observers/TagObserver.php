<?php

namespace Corals\Modules\CMS\Observers;

use Corals\Modules\CMS\Models\Tag;

class TagObserver
{

    /**
     * @param Tag $tag
     */
    public function created(Tag $tag)
    {
    }
}