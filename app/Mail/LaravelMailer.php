<?php

namespace App\Mail;

use App\Models\User;
use App\Services\Contracts\Mailer;
use Illuminate\Support\Facades\Mail;

class LaravelMailer implements Mailer
{
    public function __construct(private readonly string $adminEmail)
    {
    }

    public function sendUserWelcome(User $user): void
    {
        Mail::to($user->email)->send(new UserWelcomeMail($user));
    }

    public function notifyAdminOfNewUser(User $user): void
    {
        Mail::to($this->adminEmail)->send(new AdminNewUserMail($user));
    }
}
