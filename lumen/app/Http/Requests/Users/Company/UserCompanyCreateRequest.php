<?php

namespace App\Http\Requests\Users\Company;

use App\Http\Requests\FormRequest;
use App\Models\Company\Company;
use App\Models\Company\CompanyDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserCompanyCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool)Auth::user();
    }

    public function rules(): array
    {
        return [
            Company::TITLE => 'required|string|max:255',
            Company::DESCRIPTION => 'string|max:2500',
            Company::PHONE => 'required|string'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param ValidationException $exception
     * @return JsonResponse
     */
    protected function failedValidation(ValidationException $exception): JsonResponse
    {
        return response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $exception->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function getDto(): CompanyDto
    {
        return new CompanyDto(
            $this->get(Company::TITLE),
            $this->get(Company::PHONE),
            $this->get(Company::DESCRIPTION)
        );
    }
}

