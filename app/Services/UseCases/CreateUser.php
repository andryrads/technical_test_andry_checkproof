<?php

namespace App\Services\UseCases;

use App\Models\User;
use App\Services\Contracts\Mailer;
use App\Services\Contracts\UserRepository;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly Mailer $mailer
    ) {
    }

    /**
     * @param array{email:string,password:string,name:string} $payload
     */
    public function handle(array $payload): User
    {
        $attributes = [
            'email' => $payload['email'],
            'password' => Hash::make($payload['password']),
            'name' => $payload['name'],
        ];

        $user = $this->users->create($attributes);

        // send notification emails
        $this->mailer->sendUserWelcome($user);
        $this->mailer->notifyAdminOfNewUser($user);

        return $user;
    }
}
