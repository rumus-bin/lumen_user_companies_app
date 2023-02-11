<?php

namespace App\Http\Requests\Users\Company;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool)Auth::user();
    }
}

