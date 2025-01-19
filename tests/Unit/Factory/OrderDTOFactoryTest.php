<?php

namespace Tests\Unit;

use App\DTO\OrderDTO;
use App\Enum\OrderStatus;
use App\Factories\OrderDTOFactory;
use PHPUnit\Framework\TestCase;

class OrderDTOFactoryTest extends TestCase
{
    private OrderDTOFactory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $this->factory = app(OrderDTOFactory::class);
    }

    public function testCreateFromArrayValid(): void
    {
        $data = [
            'id' => 12,
            'petId' => 123,
            'quantity' => 1234,
            'shipDate' => '2024-01-01',
            'status' => OrderStatus::Approved->value,
            'complete' => 1
        ];

        $actual = $this->factory->createFromArray($data);

        $this->assertInstanceOf(OrderDTO::class, $actual);
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
