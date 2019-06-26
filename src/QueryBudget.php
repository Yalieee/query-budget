<?php


namespace App;


use DateTime;

class QueryBudget
{
    private $findAllBudgets = null;

    public function __construct(FindAllBudgetsInterface $findAllBudgets)
    {
        $this->findAllBudgets = $findAllBudgets;
    }

    public function query($startDate, $endDate)
    {
        $budgets = $this->findAllBudgets->findAllBudgets();
        $sTime = new DateTime($startDate);
        $eTime = new DateTime($endDate);

        $sTime = $sTime->format("Y-m");
        $eTime = $eTime->format("Y-m");

        $money = 0;
        foreach ($budgets as $budget) {
            $budgetDate = DateTime::createFromFormat('Y/m', $budget->date);
            $budgetTime = $budgetDate->format("Y-m");
            $budgetMonth = $budgetDate->format("m");
            $budgetDays = cal_days_in_month(CAL_GREGORIAN,
                $budgetDate->format("m"),
                $budgetDate->format("Y"));

            if ($sTime <= $budgetTime && $eTime >= $budgetTime) {
                $money += $budget->value;
            }
        }



        return $money;
    }
}
