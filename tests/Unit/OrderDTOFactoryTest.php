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

    /**
     * A basic unit test example.
     */
    public function testCreate(): void
    {
        $this->assertInstanceOf(
            OrderDTO::class,
            $this->factory->create(1, 1, 1, '2022', OrderStatus::Approved, true)
        );
    }

    public function testCreateFromValidResponse(): void
    {

    }
}
