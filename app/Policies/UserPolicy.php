<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $authenticatedUser, User $targetUser)
    {
        return $authenticatedUser->is($targetUser);
    }

    public function edit(User $authenticatedUser, User $targetUser)
    {
        return $authenticatedUser->is($targetUser);
    }
}
