<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Interfaces\PrintableInterface;
use App\Traits\PrintableTrait;

class UserDTO implements DTOInterface, PrintableInterface
{
    use PrintableTrait;

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