<?php

namespace App\Factories;

use App\DTO\UserDTO;
use App\Helpers\ApiResonseHelper;
use App\Interfaces\DTOInterface;
use App\Interfaces\FromArrayFactoryInterface;

class UserDTOFactory implements FromArrayFactoryInterface
{
    public function __construct(
        private ApiResonseHelper $apiResonseHelper
    ) {

    }

    public function create(
        int $id,
        string $username,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phone,
        int $userStatus
    ): UserDTO {
        return new UserDTO(
            $id,
            $username,
            $firstName,
            $lastName,
            $email,
            $password,
            $phone,
            $userStatus
        );
    }

    public function createFromArray(array $input): ?DTOInterface
    {
        $params = [
            $this->apiResonseHelper->filterIntFromArray($input, 'id'),
            $this->apiResonseHelper->filterStringFromArray($input, 'username'),
            $this->apiResonseHelper->filterStringFromArray($input, 'firstName'),
            $this->apiResonseHelper->filterStringFromArray($input, 'lastName'),
            $this->apiResonseHelper->filterStringFromArray($input, 'email'),
            $this->apiResonseHelper->filterStringFromArray($input, 'password'),
            $this->apiResonseHelper->filterStringFromArray($input, 'phone'),
            $this->apiResonseHelper->filterIntFromArray($input, 'userStatus')
        ];

        if (in_array(null, $params, true)) {
            return null;
        }

        return $this->create(...$params);
    }
}