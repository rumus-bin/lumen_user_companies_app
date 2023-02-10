<?php

namespace App\Models\User\Services;

use App\Models\User\Repositories\UserAuthTokenRepository;
use App\Models\User\Repositories\UserRepository;
use App\Models\User\User;
use App\Models\User\UserAuthToken;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;

class AuthUserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserAuthTokenRepository$authTokenRepository
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

    private function refreshToken(User $user): User
    {
        $token = Str::random(256);
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
        $authToken = $this->authTokenRepository->store($authToken);

        return $user->authToken = $authToken;
    }
}
