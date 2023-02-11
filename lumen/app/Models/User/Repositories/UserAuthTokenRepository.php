<?php

namespace App\Models\User\Repositories;

use App\Models\AbstractRepository;
use App\Models\User\UserAuthToken;

/**
 * @method UserAuthToken|null findOneByField(string $fieldName, mixed $value, array $relations = [])
 * @method UserAuthToken store(UserAuthToken $model)
 * @method null delete(UserAuthToken $mode)
 * @method null deleteById(int $id)
 * @method UserAuthToken|null fresh(UserAuthToken $model, array $relations = [])
 * @method UserAuthToken refresh(UserAuthToken $model)
 */
class UserAuthTokenRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(UserAuthToken::class);
    }
}
