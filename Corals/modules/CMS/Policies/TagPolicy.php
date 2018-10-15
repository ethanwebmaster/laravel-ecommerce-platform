<?php

namespace Corals\Modules\CMS\Policies;

use Corals\User\Models\User;
use Corals\Modules\CMS\Models\Tag;

class TagPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('CMS::tag.view')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('CMS::tag.create');
    }

    /**
     * @param User $user
     * @param Tag $tag
     * @return bool
     */
    public function update(User $user, Tag $tag)
    {
        if ($user->can('CMS::tag.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Tag $tag
     * @return bool
     */
    public function destroy(User $user, Tag $tag)
    {
        if ($user->can('CMS::tag.delete')) {
            return true;
        }
        return false;
    }


    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if (isSuperUser($user)) {
            return true;
        }

        return null;
    }
}
