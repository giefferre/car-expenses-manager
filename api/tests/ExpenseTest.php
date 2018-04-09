<?php
use PHPUnit\Framework\TestCase;

/**
 * Class ExpenseTest
 */
class ExpenseTest extends TestCase
{
    /**
     * @test
     * @dataProvider newExpenseDataProvider
     *
     * @param $expenseData
     */
    public function createExpense($expenseData)
    {
        $expense = new Expense($expenseData);

        $this->assertEquals($expenseData['carId'], $expense->getCarId());
    }

    /**
     * @test
     * @expectedException Exception
     * @dataProvider newExpenseInvalidDataProvider
     *
     * @param $expenseInvalidData
     */
    public function createInvalidExpense($expenseInvalidData)
    {
        $expense = new Expense($expenseInvalidData);
    }

    /**
     * @test
     * @dataProvider newExpenseDataProvider
     *
     * @param $expenseData
     */
    public function jsonSerialize($expenseData)
    {
        $expense = new Expense($expenseData);

        $expectedJSON = json_encode([
            "id" => $expenseData['id'],
            "carId" => $expenseData['carId'],
            "carPlateNumber" => $expenseData['carPlateNumber'],
            "amount" => $expenseData['amount'],
            "type" => $expenseData['type'],
            "reason" => $expenseData['reason'],
            "date" => $expenseData['date'],
        ]);

        $this->assertEquals($expectedJSON, json_encode($expense));
    }

    public function newExpenseDataProvider()
    {
        return [
            [
                [
                    "id" => 1,
                    "carId" => 9,
                    "carPlateNumber" => "AA000BB",
                    "amount" => 12.34,
                    "type" => "Extraordinary",
                    "reason" => "Flat tyre",
                    "date" => "2001-02-03 01:02:03",
                ],
            ],
        ];
    }

    public function newExpenseInvalidDataProvider()
    {
        return [
            [
                [
                    // missing carId
                    "carPlateNumber" => "AA000BB",
                    "amount" => 12.34,
                    "type" => "Extraordinary",
                    "reason" => "Flat tyre",
                    "date" => "2001-02-03 01:02:03",
                ],
            ],
            [
                [
                    "carId" => 9,
                    // missing carPlateNumber
                    "amount" => 12.34,
                    "type" => "Extraordinary",
                    "reason" => "Flat tyre",
                    "date" => "2001-02-03 01:02:03",
                ],
            ],
            [
                [
                    "carId" => 9,
                    "carPlateNumber" => "AA000BB",
                    // missing amount
                    "type" => "Extraordinary",
                    "reason" => "Flat tyre",
                    "date" => "2001-02-03 01:02:03",
                ],
            ],
            [
                [
                    "carId" => 9,
                    "carPlateNumber" => "AA000BB",
                    "amount" => 12.34,
                    // missing type
                    "reason" => "Flat tyre",
                    "date" => "2001-02-03 01:02:03",
                ],
            ],
            [
                [
                    "carId" => 9,
                    "carPlateNumber" => "AA000BB",
                    "amount" => 12.34,
                    "type" => "Extraordinary",
                    // missing reason
                    "date" => "2001-02-03 01:02:03",
                ],
            ],
            [
                [
                    "carId" => 9,
                    "carPlateNumber" => "AA000BB",
                    "amount" => 12.34,
                    "type" => "Extraordinary",
                    "reason" => "Flat tyre",
                    // missing date
                ],
            ],
        ];
    }
}
