<?php

namespace App\Policies;

use App\Models\User;
use App\UserPermissions;

class UserPolicy
{
    public function disable(User $user, User $model)
    {
        return $user->hasPermission(UserPermissions::DisableUser);
    }

    public function activate(User $user, User $model)
    {
        return $user->hasPermission(UserPermissions::ActivateUser);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasPermission(UserPermissions::DeleteUser);
    }
}
