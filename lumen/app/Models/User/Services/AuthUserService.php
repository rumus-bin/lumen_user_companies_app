<?php

namespace App\Models\User\Services;

use App\Mail\Users\Auth\RecoverPassword;
use App\Models\User\AuthUserDto;
use App\Models\User\Repositories\UseRestoreTokenRepository;
use App\Models\User\Repositories\UserRepository;
use App\Models\User\User;
use App\Models\User\UserAuthToken;
use App\Models\User\UserRestoreToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class AuthUserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UseRestoreTokenRepository $userRestoreTokenRepository
    ) {
    }

    public function login(string $email, string $password): ?User
    {
        $user = $this->userRepository->findByCredentials($email, $password);

        if (!$user) {
            return $user;
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
            $authToken->auth_token = $token;
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

    public function askRecoverPassword(string $email): bool
    {
        try {
            $user = $this->userRepository->findOneByField(User::EMAIL, $email, ['restoreToken']);
            if (!$user) {
                return false;
            }
            $token = Str::random(60);

            if ($user->restoreToken) {
                $restoreToken = $user->restoreToken;
            } else {
                $restoreToken = new UserRestoreToken();
            }

            $this->userRepository->saveRestoreToken($user, $restoreToken);

            $data = [
                'recover_token' => $token
            ];

            Mail::to($user->email)->send(new RecoverPassword($data));

            return true;
        } catch (\Throwable $exception) {
            // some logg logic here

            return false;
        }
    }

    public function recoverPasswordProcess(string $recoverToken): User
    {
        $restoreTokenModel = $this->userRestoreTokenRepository->findOneByField(
            UserRestoreToken::RESTORE_TOKEN,
            $recoverToken,
            ['user']
        );

        if (!$restoreTokenModel) {
            throw new NotFoundResourceException();
        }

        return $restoreTokenModel->user;
    }
}
