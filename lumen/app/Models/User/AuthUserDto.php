<?php

namespace App\Models\User;

class AuthUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $surname = null
    ) {
    }
}
