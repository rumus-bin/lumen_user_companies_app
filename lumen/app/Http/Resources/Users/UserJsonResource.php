<?php

namespace App\Http\Resources\Users;

use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read User $resource
 */
class UserJsonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user' => [
                'name' => $this->resource->name,
                'surname' => $this->resource->surname,
                'email' => $this->resource->email,
                'phone' => $this->resource->phone->phone_number
            ]
        ];
    }
}
