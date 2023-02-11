<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Resources\Users\UnauthorizedJsonResource;
use App\Http\Resources\Users\UserJsonResource;
use App\Models\User\Services\AuthUserService;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class ApiUserAuthController extends Controller
{
    public function __construct(
        private AuthUserService $authUserService
    ) {
    }

    /**
     * @param Request $request
     * @return JsonResource
     * @throws ValidationException
     */
    public function login(Request $request): JsonResource
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
        $user = $this->authUserService->login(
            $request->get('email'),
            $request->get('password')
        );

        if (!$user) {
            return new UnauthorizedJsonResource(new User());
        }

        return new UserJsonResource($user);
    }

    public function register(UserCreateRequest $request): UserJsonResource
    {
        $user = $this->authUserService->register($request->getDto());

        return new UserJsonResource($user);
    }
}
