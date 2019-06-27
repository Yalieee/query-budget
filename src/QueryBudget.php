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
        $sTimeObj = new DateTime($startDate);
        $eTimeObj = new DateTime($endDate);

        $sTime = $sTimeObj->format("Y-m");
        $eTime = $eTimeObj->format("Y-m");

        $money = 0;
        foreach ($budgets as $budget) {
            $budgetDate = DateTime::createFromFormat('Y/m', $budget->date);
            $budgetTime = $budgetDate->format("Y-m");
            $budgetMonth = $budgetDate->format("m");
            $budgetDays = cal_days_in_month(CAL_GREGORIAN,
                $budgetDate->format("m"),
                $budgetDate->format("Y"));
            $budgetDayValue = floor($budget->value/$budgetDays);
            if ($budgetTime == $sTime) {
                $days = $budgetDays - $sTimeObj->format("d") +1;
                $money += $days * $budgetDayValue;
            } else if ($budgetTime == $eTime){
                $days = $eTimeObj->format("d");
                $money += $days * $budgetDayValue;
            } else {
                $money += $budget->value;
            }
        }



        return $money;
    }
}
