<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserLoginRequest;
use App\Http\Resources\Users\UnauthorizedJsonResource;
use App\Http\Resources\Users\UserAuthenticatedJsonResource;
use App\Models\User\Services\AuthUserService;
use App\Models\User\User;
use App\Models\User\UserRestoreToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiUserAuthController extends Controller
{
    public function __construct(
        private AuthUserService $authUserService
    ) {
    }

    /**
     * @param UserLoginRequest $request
     * @return JsonResource
     */
    public function login(UserLoginRequest $request): JsonResource
    {
        $user = $this->authUserService->login(
            $request->get('email'),
            $request->get('password')
        );

        if (!$user) {
            return new UnauthorizedJsonResource(new User());
        }

        return new UserAuthenticatedJsonResource($user);
    }

    public function register(UserCreateRequest $request): UserAuthenticatedJsonResource
    {
        $user = $this->authUserService->register($request->getDto());

        return new UserAuthenticatedJsonResource($user);
    }

    public function askRecoverPassword(Request $request): JsonResponse
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users',
            ]
        );

        if ($this->authUserService->askRecoverPassword($request->get('email'))) {
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'Please check your email for continue your recover password process.'
                ]
            );
        }

        return response()->json(
            [
                'code' => 400,
                'message' => 'Something went wrong'
            ]
        );

    }

    public function recoverPassword(Request $request): JsonResource
    {
        $request->validate(
            [
                'recover_token' => 'required|string|min:60|exists:' . UserRestoreToken::TABLE_NAME . ',' .
                    UserRestoreToken::RESTORE_TOKEN
            ]
        );

        return new UserAuthenticatedJsonResource(
            $this->authUserService->recoverPasswordProcess($request->get('recover_token'))
        );
    }
}
