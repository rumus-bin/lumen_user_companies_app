<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\Services\AuthUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiUserAuthController extends Controller
{
    public function __construct(
        private AuthUserService $authUserService
    ) {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
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
            return response()->json([
                'error' => 'Unauthorized',
                'links' => [
                    'register_link' => 'The register link should be here'
                ]
            ]);
        }

        return response()->json([
            'access_token' => $user->authToken->authToken,
            'token_type' => 'bearer',
            'user' => [
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email
            ],
        ]);
    }
}
