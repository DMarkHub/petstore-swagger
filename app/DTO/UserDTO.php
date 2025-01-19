<?php

namespace App\DTO;

use App\Namespaces\DTOInterface;

class UserDTO implements DTOInterface
{
    public function __construct(
        public int $id,
        public string $username,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public string $phone,
        public int $userStatus
    ) {

    }
}