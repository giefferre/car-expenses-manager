<?php

class CarMapper extends Mapper
{
    public function getCars()
    {
        $sql = "SELECT cars.*
            FROM cars";
        $query = $this->db->query($sql);

        $cars = [];
        while ($row = $query->fetch()) {
            $cars[] = new Car($row);
        }
        return $cars;
    }

    public function getCarById(string $carId) {
        $sql = "SELECT c.*
            FROM cars c
            WHERE c.id = :car_id";
        $query = $this->db->prepare($sql);
        $result = $query->execute(["car_id" => $carId]);

        if (!$result) {
            throw new Exception("record not found");
        }

        return new Car($query->fetch());
    }

    public function save(Car $car)
    {
        $sql = "INSERT INTO cars
            (manufacturer, model, plateNumber) VALUES
            (:manufacturer, :model, :plateNumber)";
        $query = $this->db->prepare($sql);

        $result = $query->execute([
            "manufacturer" => $car->getManufacturer(),
            "model" => $car->getModel(),
            "plateNumber" => $car->getPlateNumber(),
        ]);

        if (!$result) {
            throw new Exception("could not save record");
        }
    }
}
