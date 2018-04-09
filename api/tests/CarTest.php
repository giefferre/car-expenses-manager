<?php
use PHPUnit\Framework\TestCase;

/**
 * Class CarTest
 */
class CarTest extends TestCase
{
    /**
     * @test
     * @dataProvider newCarDataProvider
     *
     * @param $carData
     */
    public function createCar($carData)
    {
        $car = new Car($carData);

        $this->assertEquals($carData['manufacturer'], $car->getManufacturer());
        $this->assertEquals($carData['model'], $car->getModel());
        $this->assertEquals($carData['plateNumber'], $car->getPlateNumber());
    }

    /**
     * @test
     * @dataProvider newCarDataProvider
     *
     * @param $carData
     */
    public function jsonSerialize($carData)
    {
        $car = new Car($carData);

        $expectedJSON = json_encode([
            "id" => $carData['id'],
            "manufacturer" => $carData['manufacturer'],
            "model" => $carData['model'],
            "plateNumber" => $carData['plateNumber'],
        ]);

        $this->assertEquals($expectedJSON, json_encode($car));
    }

    public function newCarDataProvider()
    {
        return [
            [
                [
                    "id" => 1,
                    "manufacturer" => "Alfa Romeo",
                    "model" => "MiTo",
                    "plateNumber" => "AA000BB",
                ],
                [
                    "manufacturer" => "Fiat",
                    "model" => "Panda",
                    "plateNumber" => "EE000DD",
                ],
            ],
        ];
    }
}
