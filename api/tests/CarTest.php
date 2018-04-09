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
        $this->assertEquals($carData['created'], $car->getCreationDate());
        $this->assertEquals($carData['updated'], $car->getUpdatedDate());
    }

    /**
     * @test
     * @expectedException Exception
     * @dataProvider newCarInvalidDataProvider
     *
     * @param $carInvalidData
     */
    public function createInvalidCar($carInvalidData)
    {
        $car = new Car($carInvalidData);
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
                [
                    "created" => "2001-02-03 01:02:03",
                    "updated" => "2011-12-13 11:12:13",
                    "manufacturer" => "Fiat",
                    "model" => "Panda",
                    "plateNumber" => "EE000DD",
                ],
            ],
        ];
    }

    public function newCarInvalidDataProvider()
    {
        return [
            [
                [
                    // missing manufacturer
                    "model" => "MiTo",
                    "plateNumber" => "AA000BB",
                ],
            ], [
                [
                    "manufacturer" => "Fiat",
                    // missing model
                    "plateNumber" => "EE000DD",
                ],
            ], [
                [
                    "manufacturer" => "Fiat",
                    "model" => "Panda",
                    // missing plateNumber
                ],
            ],
        ];
    }
}
