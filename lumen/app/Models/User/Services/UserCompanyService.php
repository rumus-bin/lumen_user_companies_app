<?php

namespace App\Models\User\Services;

use App\Models\Company\Company;
use App\Models\Company\CompanyDto;
use App\Models\Company\Repositories\CompanyRepository;
use App\Models\PhoneNumber\PhoneNumber;
use App\Models\User\Repositories\UserRepository;
use App\Models\User\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserCompanyService
{
    private CompanyRepository $companyRepository;
    private UserRepository $userRepository;

    public function __construct(CompanyRepository $companyRepository, UserRepository $userRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->userRepository = $userRepository;
    }

    public function getAuthUserCompanies(User $user): Collection
    {
        return $user->companies;
    }

    public function addCompany(User $user, CompanyDto $companyDto): Company
    {
        $company = new Company(
            [
                Company::TITLE => $companyDto->title,
                Company::DESCRIPTION => $companyDto->description
            ]
        );

        $company = $this->userRepository->saveCompany($user, $company);
        $phoneNumber = new PhoneNumber([PhoneNumber::PHONE_NUMBER => $companyDto->phone]);
        $this->companyRepository->savePhone($company, $phoneNumber);

        return $company;
    }
}
