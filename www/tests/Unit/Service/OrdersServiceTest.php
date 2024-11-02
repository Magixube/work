<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\OrdersService;
use PHPUnit\Framework\Attributes\DataProvider;

class OrdersServiceTest extends TestCase
{
    #[DataProvider('processDataProvider')]
    public function testProcess(array $parameters, array $expected)
    {
        // Create an instance of the OrdersService
        $service = new OrdersService();

        if (isset($expected['expectedException']) && $expected['expectedException']) {
            $this->expectException(\Exception::class);
            $this->expectExceptionMessage($expected['expectedExceptionMessage']);
            $service->process($parameters);
        } else {
            $result = $service->process($parameters);
            $this->assertEquals($expected, $result);
        }

        // Call the process method with the test parameters
        $result = $service->process($parameters);

        // Assert the processed parameters match the expected outcome
        $this->assertEquals($expected, $result);
    }

    public static function processDataProvider(): array
    {
        return [
            // Test Name should be capitalized
            [
                'parameters' => [
                    'id' => 'A0000001',
                    'name' => 'Melody Holiday inn',
                    'address' => [
                        'city' => 'taipei-city',
                        'district' => 'da-an-district',
                        'street' => 'fuxing-south-road',
                    ],
                    'price' => '2000',
                    'currency' => "USD"
                ],
                'expected' => [
                    'expectedException' => true,
                    'expectedExceptionMessage' => 'Name is not capitalized',
                ],
            ],

            // Test Name should contains only English
            [
                'parameters' => [
                    'id' => 'A0000001',
                    'name' => 'Melody Holiday Inn!',
                    'address' => [
                        'city' => 'taipei-city',
                        'district' => 'da-an-district',
                        'street' => 'fuxing-south-road',
                    ],
                    'price' => '2000',
                    'currency' => "USD"
                ],
                'expected' => [
                    'expectedException' => true,
                    'expectedExceptionMessage' => 'Name contains non-English characters',
                ],
            ],

            // Test currency format
            [
                'parameters' => [
                    'id' => 'A0000001',
                    'name' => 'Melody Holiday Inn',
                    'address' => [
                        'city' => 'taipei-city',
                        'district' => 'da-an-district',
                        'street' => 'fuxing-south-road',
                    ],
                    'price' => '2000',
                    'currency' => "EUR"
                ],
                'expected' => [
                    'expectedException' => true,
                    'expectedExceptionMessage' => 'Currency format is wrong',
                ],
            ],

            // Test Price must less than and equal 2000
            [
                'parameters' => [
                    'id' => 'A0000001',
                    'name' => 'Melody Holiday Inn',
                    'address' => [
                        'city' => 'taipei-city',
                        'district' => 'da-an-district',
                        'street' => 'fuxing-south-road',
                    ],
                    'price' => '2050',
                    'currency' => "USD"
                ],
                'expected' => [
                    'expectedException' => true,
                    'expectedExceptionMessage' => 'Price is over 2000',
                ],
            ],
            // Test Currency Converter
            [
                'parameters' => [
                    'id' => 'A0000001',
                    'name' => 'Melody Holiday Inn',
                    'address' => [
                        'city' => 'taipei-city',
                        'district' => 'da-an-district',
                        'street' => 'fuxing-south-road',
                    ],
                    'price' => '200',
                    'currency' => "USD"
                ],
                'expected' => [
                    'id' => 'A0000001',
                    'name' => 'Melody Holiday Inn',
                    'address' => [
                        'city' => 'taipei-city',
                        'district' => 'da-an-district',
                        'street' => 'fuxing-south-road',
                    ],
                    'price' => '6200',
                    'currency' => "TWD"
                ],
            ],
        ];
    }
}
