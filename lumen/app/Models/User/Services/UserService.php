<?php

namespace App\Models\User\Services;

use App\Models\User\Repositories\UserRepository;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function create(string $name, string $email, string $password, ?string $surname = null): User
    {
        $user = new User(
            [
                User::NAME => $name,
                User::SURNAME => $surname,
                User::EMAIL => $email,
                User::PASSWORD => Hash::make($password),
            ]
        );

        return $this->userRepository->store($user);
    }
}
