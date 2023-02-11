<?php

namespace App\Models\User\Repositories;

use App\Models\AbstractRepository;
use App\Models\User\UserRestoreToken;
use Illuminate\Database\Eloquent\Model;

/**
 * @method UserRestoreToken|null findOneByField(string $fieldName, mixed $value, array $relations = [])
 * @method UserRestoreToken store(Model $model)
 * @method null delete(Model $mode)
 * @method null deleteById(int $id)
 * @method UserRestoreToken|null fresh(Model $model, array $relations = [])
 * @method UserRestoreToken refresh(Model $model)
 */
class UseRestoreTokenRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(UserRestoreToken::class);
    }
}
