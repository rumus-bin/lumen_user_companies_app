<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\FormRequest;
use App\Models\User\AuthUserDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failedValidation(ValidationException $exception): JsonResponse
    {
        return response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $exception->errors(),
        ], JsonResponse::HTTP_BAD_REQUEST);
    }
}

