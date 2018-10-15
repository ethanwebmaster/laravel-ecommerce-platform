<?php

namespace Corals\User\Observers;

use Corals\User\Models\Role;
use Corals\User\Models\User;

class UserObserver
{

    /**
     * @param User $user
     */
    public function created(User $user)
    {
        if (!$user->hasAnyRole(Role::all())) {
            $user->assignRole(\Settings::get('default_user_role', 'Member'));
        }
    }

    /**
     * @param User $user
     * @throws \Exception
     */
    public function deleted(User $user)
    {

    }
}