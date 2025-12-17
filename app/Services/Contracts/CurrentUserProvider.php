<?php

namespace App\Services\Contracts;

use App\Models\User;

interface CurrentUserProvider
{
    /**
     * Return the currently authenticated user, or null if guest.
     */
    public function getCurrentUser(): ?User;
}
