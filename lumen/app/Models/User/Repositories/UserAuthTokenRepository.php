<?php

namespace App\Models\User\Repositories;

use App\Models\AbstractRepository;
use App\Models\User\UserAuthToken;
use Illuminate\Database\Eloquent\Model;

/**
 * @method UserAuthToken|null findOneByField(string $fieldName, mixed $value, array $relations = [])
 * @method UserAuthToken store(Model $model)
 * @method null delete(Model $mode)
 * @method null deleteById(int $id)
 * @method UserAuthToken|null fresh(Model $model, array $relations = [])
 * @method UserAuthToken refresh(Model $model)
 */
class UserAuthTokenRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(UserAuthToken::class);
    }
}
