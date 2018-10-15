<?php

namespace Corals\Modules\Ecommerce\Policies;

use Corals\User\Models\User;

class RatingPolicy
{


    public function create(User $user)
    {
        return $user->can('Ecommerce::rating.create');
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
