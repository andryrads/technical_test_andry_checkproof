<?php

namespace App\Services\Contracts;

use App\Models\User;

interface Mailer
{
    /**
     * Notify the user about account creation.
     */
    public function sendUserWelcome(User $user): void;

    /**
     * Notify the administrator about new user creation.
     */
    public function notifyAdminOfNewUser(User $user): void;
}
