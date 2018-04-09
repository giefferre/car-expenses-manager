<?php

class ExpenseMapper extends Mapper
{
    public function getExpenses(string $startDate, string $endDate)
    {
        $sql = "SELECT e.*, c.id AS carId, c.plateNumber AS carPlateNumber
            FROM expenses e
            JOIN cars c ON (c.id = e.car_id)
            WHERE e.`date` > '$startDate'
            AND e.`date` <= '$endDate'";
        $query = $this->db->query($sql);

        $expenses = [];
        while ($row = $query->fetch()) {
            $expenses[] = new Expense($row);
        }
        return $expenses;
    }

    public function save(Expense $expense)
    {
        $sql = "INSERT INTO expenses
            (car_id, amount, type, reason, date) VALUES
            (:carId, :amount, :type, :reason, :date)";
        $query = $this->db->prepare($sql);

        $result = $query->execute([
            "carId" => $expense->getCarId(),
            "amount" => $expense->getAmount(),
            "type" => $expense->getType(),
            "reason" => $expense->getReason(),
            "date" => $expense->getDate(),
        ]);

        if (!$result) {
            throw new Exception("could not save record");
        }
    }
}
