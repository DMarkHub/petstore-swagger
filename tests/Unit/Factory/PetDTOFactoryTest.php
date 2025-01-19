<?php

namespace Tests\Unit;

use App\DTO\PetDTO;
use App\Enum\PetStatus;
use App\Factories\PetDTOFactory;
use PHPUnit\Framework\TestCase;

class PetDTOFactoryTest extends TestCase
{
    private PetDTOFactory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $this->factory = app(PetDTOFactory::class);
    }

    public function testCreateFromArrayValid(): void
    {
        $data = [
            'id' => 12,
            'category' => [
                'id' => 1,
                'name' => 'category name'
            ],
            'name' => 'pet name',
            'photoUrls' => ['photo url'],
            'tags' => [
                ['id' => 1, 'name' => 'tag name'],
                ['id' => 2, 'name' => 'tag name']
            ],
            'status' => PetStatus::Available->value
        ];

        $actual = $this->factory->createFromArray($data);

        $this->assertInstanceOf(PetDTO::class, $actual);
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
