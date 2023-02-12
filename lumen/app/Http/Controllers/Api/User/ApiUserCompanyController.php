<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Company\UserCompanyCreateRequest;
use App\Http\Requests\Users\Company\UserCompanyRequest;
use App\Http\Resources\Company\CompanyJsonResource;
use App\Http\Resources\Users\UserCompaniesJsonResource;
use App\Models\User\Services\UserCompanyService;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

class ApiUserCompanyController extends Controller
{
    public function __construct(
        private readonly UserCompanyService $userCompanyService
    ) {
    }

    public function index(UserCompanyRequest $request): UserCompaniesJsonResource
    {
        /** @var User $user */
        $user = Auth::user();

        return new UserCompaniesJsonResource($user);
    }

    public function create(UserCompanyCreateRequest $request): CompanyJsonResource
    {
        /** @var User $user */
        $user = Auth::user();

        $company = $this->userCompanyService->addCompany($user, $request->getDto());

        return new CompanyJsonResource($company);
    }
}
