<?php

namespace App\Http\Resources\Users;

use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read User $resource
 */
class UserCompaniesJsonResource extends JsonResource
{
    public function toArray($request): array
    {
        $companiesData = $this->getCompaniesData();
        return [
            'user' => [
                'name' => $this->resource->name,
                'surname' => $this->resource->surname,
                'email' => $this->resource->email,
                'phone' => $this->resource->phone->phone_number,
                'companies' => $companiesData
            ]
        ];
    }

    private function getCompaniesData(): array
    {
        $data = [];
        foreach ($this->resource->companies as $company) {
            $data[] = [
                'title' => $company->title,
                'description' => $company->description,
                'phone' => $company->phone->phone_number
            ];
        }

        return $data;
    }
}
