<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $authenticatedUser, User $user)
    {
        return $authenticatedUser->id == $user->id;
    }
    public function update( $authenticatedUser, User $user)
    {
        return $authenticatedUser->id == $user->id;
    }
    public function delete( $authenticatedUser, User $user)
    {
        return $authenticatedUser->id == $user->id;
    }
}
