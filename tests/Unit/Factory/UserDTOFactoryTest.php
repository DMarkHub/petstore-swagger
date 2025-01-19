<?php

namespace Tests\Unit;

use App\DTO\UserDTO;
use App\Factories\UserDTOFactory;
use PHPUnit\Framework\TestCase;

class UserDTOFactoryTest extends TestCase
{
    private UserDTOFactory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $this->factory = app(UserDTOFactory::class);
    }

    public function testCreateFromArrayValid(): void
    {
        $data = [
            'id' => 12,
            'username' => 'yx',
            'firstName' => 'Xavery',
            'lastName' => 'Yanos',
            'email' => 'test@email.com',
            'password' => 'xxx',
            'phone' => '123123123',
            'userStatus' => 1
        ];

        $actual = $this->factory->createFromArray($data);

        $this->assertInstanceOf(UserDTO::class, $actual);
    }

    public function testCreateFromArrayInvalid(): void
    {
        $data = [
            'id' => 1
        ];

        $actual = $this->factory->createFromArray($data);

        $this->assertEquals(null, $actual);
    }

    public function testCreateFromEmptyArray(): void
    {
        $data = [];

        $actual = $this->factory->createFromArray($data);

        $this->assertEquals(null, $actual);
    }
}
