<?php

namespace Corals\User\Classes;

use Corals\User\Models\User;

class Users
{
    /**
     * Users constructor.
     */
    function __construct()
    {
    }


    /**
     * @param string $type
     * @return mixed
     */
    public function getUsersList($role = "all")
    {
        if ($role != "all") {
            $users = User::whereHas('roles', function ($q) use ($role) {
                $q->where('name', $role);
            })->get();

        } else {
            $users = User::pluck('name', 'id');

        }
        return $users;
    }

}