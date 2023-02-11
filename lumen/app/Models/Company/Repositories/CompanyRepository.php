<?php

namespace App\Models\Company\Repositories;

use App\Models\AbstractRepository;
use App\Models\Company\Company;
use App\Models\PhoneNumber\PhoneNumber;

/**
 * @method Company|null findOneByField(string $fieldName, mixed $value, array $relations = [])
 * @method Company store(Company $model)
 * @method null delete(Company $mode)
 * @method null deleteById(int $id)
 * @method Company|null fresh(Company $model, array $relations = [])
 * @method Company refresh(Company $model)
 */
class CompanyRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Company::class);
    }

    public function savePhone(Company $company, PhoneNumber $phone): PhoneNumber
    {
        /** @var PhoneNumber $phoneNumber */
        $phoneNumber = $company->phone()->save($phone);

        return $phoneNumber;
    }
}
