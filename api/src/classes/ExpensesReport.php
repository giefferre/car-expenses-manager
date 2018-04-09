<?php

/**
 * Class ExpensesReport collects multiple Expenses within a time period.
 */
class ExpensesReport implements JsonSerializable
{
    protected $totalAmountForPeriod;
    protected $periodStart;
    protected $periodEnd;
    protected $list;

    /**
     * Instantiates the ExpensesReport object
     *
     * @param array $expenses The list of expenses included in the report
     * @param string $startDate The start date of the report
     * @param string $endDate The end date of the report
     */
    public function __construct(array $expenses, string $startDate, string $endDate)
    {
        $this->periodStart = $startDate;
        $this->periodEnd = $endDate;
        $this->list = $expenses;
        $this->calculateTotalAmount();
    }

    /**
     * Calculates the total amount of expenses for the report
     */
    private function calculateTotalAmount()
    {
        $amount = 0;

        foreach ($this->list as $expense) {
            $amount += $expense->getAmount();
        }

        $this->totalAmountForPeriod = $amount;
    }

    /**
     * Returns the JSON representation of the class
     */
    public function jsonSerialize()
    {
        return array(
            "totalAmountForPeriod" => $this->totalAmountForPeriod,
            "periodStart" => $this->periodStart,
            "periodEnd" => $this->periodEnd,
            "list" => $this->list
        );
    }

    /**
     * Returns report's total amount
     */
    public function getTotalAmount()
    {
        return $this->totalAmountForPeriod;
    }

    /**
     * Returns report's start date
     */
    public function getPeriodStart()
    {
        return $this->periodStart;
    }

    /**
     * Returns report's end date
     */
    public function getPeriodEnd()
    {
        return $this->periodEnd;
    }
}
