<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Contracts\CurrentUserProvider;
use Illuminate\Support\Facades\Auth;

class CurrentUser implements CurrentUserProvider
{
    public function getCurrentUser(): ?User
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user;
    }
}
