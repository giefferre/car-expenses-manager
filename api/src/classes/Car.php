<?php

/**
 * Class Car represents an object which will make its user
 * pay a lot of money as it ages up.
 */
class Car implements JsonSerializable
{
    protected $id;
    protected $manufacturer;
    protected $model;
    protected $plateNumber;
    protected $created;
    protected $updated;

    /**
     * Accepts a key value array matching class properties
     * and istantiates a Car object
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data)
    {
        if (!isset($data['manufacturer'])
            || !isset($data['model'])
            || !isset($data['plateNumber'])) {
            throw new Exception('invalid data given');
        }

        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['created'])) {
            $this->created = $data['created'];
        }
        if (isset($data['updated'])) {
            $this->updated = $data['updated'];
        }
        $this->manufacturer = $data['manufacturer'];
        $this->model = $data['model'];
        $this->plateNumber = $data['plateNumber'];
    }

    /**
     * Returns the JSON representation of the class
     */
    public function jsonSerialize()
    {
        return array(
            "id" => $this->id,
            "manufacturer" => $this->manufacturer,
            "model" => $this->model,
            "plateNumber" => $this->plateNumber,
        );
    }

    /**
     * Returns car's manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Returns car's model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Returns car's plate number
     */
    public function getPlateNumber()
    {
        return $this->plateNumber;
    }

    /**
     * Returns car's creation date
     */
    public function getCreationDate()
    {
        return $this->created;
    }

    /**
     * Returns car's update date
     */
    public function getUpdatedDate()
    {
        return $this->updated;
    }
}
