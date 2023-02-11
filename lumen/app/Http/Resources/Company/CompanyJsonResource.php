<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\Users\UserJsonResource;
use App\Models\Company\Company;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Company $resource
 */
class CompanyJsonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'company' => [
                Company::TITLE => $this->resource->title,
                Company::DESCRIPTION => $this->resource->description,
                'phone' => $this->resource->phone->phone_number,
                'user' => new UserJsonResource($this->resource->user)
            ]
        ];
    }
}
