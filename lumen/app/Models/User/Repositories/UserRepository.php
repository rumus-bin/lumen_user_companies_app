<?php

namespace App\Models\User\Repositories;

use App\Models\AbstractRepository;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * @method User[] findAll(array $relations = [])
 * @method User|null findById(int $id, array $relations = [])
 * @method User|null findOneByField(string $fieldName, mixed $value, array $relations = [])
 * @method User[] findAllByField(string $fieldName, mixed $value, array $relations = [])
 * @method User store(Model $model)
 * @method null delete(Model $mode)
 * @method null deleteMany(Collection $models)
 * @method null deleteById(int $id)
 * @method User|null fresh(Model $model, array $relations = [])
 * @method User refresh(Model $model)
 */
class UserRepository extends AbstractRepository
{
    public function findByCredentials(string $email, string $password): ?User
    {
        $qb = $this->createQueryBuilder();
        /** @var User|null $user */
        $user = $qb->where(User::EMAIL, $email)
            ->where(User::PASSWORD, Hash::make($password))
            ->with('authToken')
            ->first();

        return $user;
    }
}
