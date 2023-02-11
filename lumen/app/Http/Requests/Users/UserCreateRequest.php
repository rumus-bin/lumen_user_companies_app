<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\FormRequest;
use App\Models\User\AuthUserDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'string|max:255',
            'email' => 'required|email|unique:users',
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
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function getDto(): AuthUserDto
    {
        return new AuthUserDto(
            $this->get('name'),
            $this->get('email'),
            $this->get('password'),
            $this->get('surname')
        );
    }
}

