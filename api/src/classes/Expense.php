<?php

/**
 * Class Expense is a cost required for a given car.
 */
class Expense implements JsonSerializable
{
    protected $id;
    protected $carId;
    protected $carPlateNumber;
    protected $amount;
    protected $type;
    protected $reason;
    protected $date;
    protected $created;
    protected $updated;

    /**
     * Accepts a key value array matching class properties
     * and istantiates an Expense object
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data)
    {
        if (!isset($data['carId'])
            || !isset($data['carPlateNumber'])
            || !isset($data['amount'])
            || !isset($data['type'])
            || !isset($data['reason'])
            || !isset($data['date'])) {
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
        $this->carId = $data['carId'];
        $this->carPlateNumber = $data['carPlateNumber'];
        $this->amount = $data['amount'];
        $this->type = $data['type'];
        $this->reason = $data['reason'];
        $this->date = $data['date'];
    }

    /**
     * Returns the JSON representation of the class
     */
    public function jsonSerialize()
    {
        return array(
            "id" => $this->id,
            "carId" => $this->carId,
            "carPlateNumber" => $this->carPlateNumber,
            "amount" => $this->amount,
            "type" => $this->type,
            "reason" => $this->reason,
            "date" => $this->date,
        );
    }

    /**
     * Returns expense's carId
     */
    public function getCarId()
    {
        return $this->carId;
    }

    /**
     * Returns expense's car plate number
     */
    public function getCarPlateNumber()
    {
        return $this->carPlateNumber;
    }

    /**
     * Returns expense's amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns expense's type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns expense's reason
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Returns expense's date
     */
    public function getDate()
    {
        return $this->date;
    }
}
