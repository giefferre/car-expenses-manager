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
