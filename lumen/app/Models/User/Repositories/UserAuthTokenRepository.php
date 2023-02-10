<?php

namespace App\Models\User\Repositories;

use App\Models\AbstractRepository;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @method User|null findOneByField(string $fieldName, mixed $value, array $relations = [])
 * @method User store(Model $model)
 * @method null delete(Model $mode)
 * @method null deleteById(int $id)
 * @method User|null fresh(Model $model, array $relations = [])
 * @method User refresh(Model $model)
 */
class UserAuthTokenRepository extends AbstractRepository
{
}
