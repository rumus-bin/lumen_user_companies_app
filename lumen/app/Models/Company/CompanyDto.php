<?php

namespace App\Models\Company;

class CompanyDto
{
    public function __construct(
        public string $title,
        public string $phone,
        public ?string $description = null,
    ) {
    }
}
