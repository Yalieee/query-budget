<?php


namespace App;


use DateTime;

class QueryBudget
{
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
        //$sMonth = $sTime->format("m");
        //$sDay = $sTime->format("d");

        $eTime = $eTime->format("Y-m");
        //$eMonth = $eTime->format("m");
        //$eDay = $eTime->format("d");
        $money = 0;
        foreach ($budgets as $budget) {
            $budgetDate = new DateTime($budget->date);
            $budgetTime = $budgetDate->format("Y-m");
            //$budgetMonth = $budgetDate->format("m");

            if ($sTime <= $budgetTime && $eTime >= $budgetTime) {
                $money += $budget->value;
            }


        }



        return $money;
    }
}
