<?php

namespace App\Models\User\Repositories;

use App\Models\AbstractRepository;
use App\Models\PhoneNumber\PhoneNumber;
use App\Models\User\User;
use App\Models\User\UserAuthToken;
use App\Models\User\UserRestoreToken;
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
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function findByCredentials(string $email, string $password): ?User
    {
        $qb = $this->createQueryBuilder();
        /** @var User|null $user */
        $user = $qb->where(User::EMAIL, $email)
            ->with('authToken')
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }

    public function saveAuthToken(User $user, UserAuthToken $authToken): UserAuthToken
    {
        /** @var UserAuthToken $authTokenModel */
        $authTokenModel = $user->authToken()->save($authToken);

        return $authTokenModel;
    }

    public function saveRestoreToken(User $user, UserRestoreToken $token): UserRestoreToken
    {
        /** @var UserRestoreToken $tokenModel */
        $tokenModel = $user->restoreToken()->save($token);

        return $tokenModel;
    }

    public function savePhoneNumber(User $user, Model $phoneNumber): PhoneNumber
    {
        /** @var PhoneNumber $phone */
        $phone = $user->phone()->save($phoneNumber);

        return $phone;
    }
}
