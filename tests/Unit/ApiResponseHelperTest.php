<?php

namespace Tests\Unit;

use App\Enum\OrderStatus;
use App\Helpers\ApiResonseHelper;
use PHPUnit\Framework\TestCase;

class ApiResponseHelperTest extends TestCase
{
    private ApiResonseHelper $helper;

    public function setUp(): void
    {
        parent::setUp();

        $this->helper = app(ApiResonseHelper::class);
    }

    public function testFilterIntValid(): void
    {
        $data = [
            'key' => 6
        ];

        $this->assertEquals(
            $data['key'],
            $this->helper->filterIntFromArray($data, 'key')
        );
    }

    public function testFilterIntInvalid(): void
    {
        $data = [
            'key' => 'example'
        ];

        $this->assertEquals(
            null,
            $this->helper->filterIntFromArray($data, 'key')
        );
    }

    public function testFilterIntNotSet(): void
    {
        $data = [];

        $this->assertEquals(
            null,
            $this->helper->filterIntFromArray($data, 'key')
        );
    }

    public function testFilterStringValid(): void
    {
        $data = [
            'key' => 'example'
        ];

        $this->assertEquals(
            $data['key'],
            $this->helper->filterStringFromArray($data, 'key')
        );
    }

    public function testFilterStringInvalid(): void
    {
        $data = [
            'key' => 1
        ];

        $this->assertEquals(
            null,
            $this->helper->filterStringFromArray($data, 'key')
        );
    }

    public function testFilterStringNotSet(): void
    {
        $data = [];

        $this->assertEquals(
            null,
            $this->helper->filterIntFromArray($data, 'key')
        );
    }

    public function testFilterBoolValid(): void
    {
        $data = [
            'key' => true
        ];

        $this->assertEquals(
            $data['key'],
            $this->helper->filterBoolFromArray($data, 'key')
        );
    }

    public function testFilterBoolInvalid(): void
    {
        $data = [
            'key' => 10
        ];

        $this->assertEquals(
            null,
            $this->helper->filterBoolFromArray($data, 'key')
        );
    }

    public function testFilterBoolNotSet(): void
    {
        $data = [];

        $this->assertEquals(
            null,
            $this->helper->filterBoolFromArray($data, 'key')
        );
    }


    public function testFilterEnumValid(): void
    {
        $data = [
            'key' => 'approved'
        ];

        $this->assertInstanceOf(
            OrderStatus::class,
            $this->helper->filterEnumFromArray($data, 'key', OrderStatus::class)
        );
    }

    public function testFilterEnumInvalid(): void
    {
        $data = [
            'key' => 1
        ];

        $this->assertEquals(
            null,
            $this->helper->filterEnumFromArray($data, 'key', OrderStatus::class)
        );
    }

    public function testFilterEnumNotSet(): void
    {
        $data = [];

        $this->assertEquals(
            null,
            $this->helper->filterEnumFromArray($data, 'key', OrderStatus::class)
        );
    }
}
