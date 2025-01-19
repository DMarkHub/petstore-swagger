<?php

namespace Tests\Unit;

use App\DTO\CategoryDTO;
use App\Factories\CategoryDTOFactory;
use PHPUnit\Framework\TestCase;

class CategoryDTOFactoryTest extends TestCase
{
    private CategoryDTOFactory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $this->factory = app(CategoryDTOFactory::class);
    }

    public function testCreateFromArrayValid(): void
    {
        $data = [
            'id' => 1,
            'name' => 'name'
        ];

        $actual = $this->factory->createFromArray($data);

        $this->assertInstanceOf(CategoryDTO::class, $actual);
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
