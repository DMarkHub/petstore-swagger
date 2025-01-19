<?php

namespace Tests\Unit;

use App\DTO\TagDTO;
use App\Factories\TagDTOFactory;
use PHPUnit\Framework\TestCase;

class TagDTOFactoryTest extends TestCase
{
    private TagDTOFactory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $this->factory = app(TagDTOFactory::class);
    }

    public function testCreateFromArrayValid(): void
    {
        $data = [
            'id' => 1,
            'name' => 'name'
        ];

        $actual = $this->factory->createFromArray($data);

        $this->assertInstanceOf(TagDTO::class, $actual);
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
