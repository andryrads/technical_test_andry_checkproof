<?php

namespace App\Services\Support;

use App\Models\User;

class UserPermissionService
{
    /**
     * Determine editing based on role rules.
     */
    public function canEdit(User $actor, User $target): bool
    {
        if ($actor->role === 'administrator') {
            return true;
        }

        if ($actor->role === 'manager') {
            return $target->role === 'user';
        }

        return $actor->id === $target->id;
    }
}
