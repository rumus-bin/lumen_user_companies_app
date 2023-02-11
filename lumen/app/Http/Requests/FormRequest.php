<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class FormRequest
{
    use ProvidesConvenienceMethods;

    public Request $request;

    /**
     * @param Request $request
     * @param array $messages
     * @param array $customAttributes
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Request $request, array $messages = [], array $customAttributes = [])
    {
        $this->request = $request;

        if (!$this->authorize()) throw new UnauthorizedException;

        $this->validate($this->request, $this->rules(), $messages, $customAttributes);
    }

    public function get(string $key, $default = null)
    {
        return $this->request->get($key, $default);
    }

    protected function authorize(): bool
    {
        return true;
    }

    protected function rules(): array
    {
        return [];
    }
}
