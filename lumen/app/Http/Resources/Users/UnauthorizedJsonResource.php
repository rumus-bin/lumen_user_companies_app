<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UnauthorizedJsonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'error' => [
                'message' => 'Unauthorized',
                'code' => 401
            ],
            'links' => [
                'register_link' => 'The register link should be here'
            ]
        ];
    }
}
