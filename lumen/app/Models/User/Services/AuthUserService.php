<?php

namespace App\Models\User\Services;

use App\Models\User\AuthUserDto;
use App\Models\User\Repositories\UserRepository;
use App\Models\User\User;
use App\Models\User\UserAuthToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;

class AuthUserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function login(string $email, string $password): ?User
    {
        $user = $this->userRepository->findByCredentials($email, $password);

        if (!$user) {
            throw new UnauthorizedException('User not exists. Please check your credentials.');
        }

        return $this->refreshToken($user);
    }

    public function register(AuthUserDto $authUserDto): ?User
    {
        $user = new User(
            [
                User::NAME => $authUserDto->name,
                User::SURNAME => $authUserDto->surname,
                User::EMAIL => $authUserDto->email,
                User::PASSWORD => Hash::make($authUserDto->password)
            ]
        );

        $this->userRepository->store($user);

        return $this->refreshToken($user);
    }

    private function refreshToken(User $user): User
    {
        $token = Str::random(255);
        $authToken = $user->authToken;

        if ($authToken) {
            $authToken->authToken = $token;
        } else {
            $authToken = new UserAuthToken(
                [
                    UserAuthToken::AUTH_TOKEN => $token
                ]
            );
        }

        $user->authToken = $this->userRepository->saveAuthToken($user, $authToken);

        return $user;
    }
}
