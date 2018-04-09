<?php
use PHPUnit\Framework\TestCase;

/**
 * Class ExpensesReportTest
 */
class ExpensesReportTest extends TestCase
{
    /**
     * @test
     * @dataProvider newExpensesReportDataProvider
     *
     * @param $expensesReportData
     */
    public function createExpensesReport($expensesReportData)
    {
        $report = new ExpensesReport(
            $expensesReportData['list'],
            $expensesReportData['startDate'],
            $expensesReportData['endDate']
        );

        $this->assertEquals($expensesReportData['startDate'], $report->getPeriodStart());
    }

    /**
     * @test
     * @dataProvider newExpensesReportDataProvider
     *
     * @param $expenseData
     */
    public function jsonSerialize($expensesReportData)
    {
        $report = new ExpensesReport(
            $expensesReportData['list'],
            $expensesReportData['startDate'],
            $expensesReportData['endDate']
        );

        $expectedJSON = json_encode([
            "totalAmountForPeriod" => 40.50,
            "periodStart" => $expensesReportData['startDate'],
            "periodEnd" => $expensesReportData['endDate'],
            "list" => $expensesReportData['list'],
        ]);

        $this->assertEquals($expectedJSON, json_encode($report));
    }

    public function newExpensesReportDataProvider()
    {
        return [
            [
                [
                    "list" => [
                        new Expense([
                            "id" => 1,
                            "carId" => 9,
                            "carPlateNumber" => "AA000BB",
                            "amount" => 15.15,
                            "type" => "Extraordinary",
                            "reason" => "Flat tyre",
                            "date" => "2017-01-01 01:02:03",
                        ]),
                        new Expense([
                            "id" => 2,
                            "carId" => 9,
                            "carPlateNumber" => "AA000BB",
                            "amount" => 25.35,
                            "type" => "Extraordinary",
                            "reason" => "Flat tyre",
                            "date" => "2017-01-02 01:02:03",
                        ]),
                    ],
                    "startDate" => "2017-01-01",
                    "endDate" => "2018-01-01",
                ],
            ],
        ];
    }
}
