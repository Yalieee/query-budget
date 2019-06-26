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

        $sYear = $sTime->format("Y");
        $sMonth = $sTime->format("m");
        $sDay = $sTime->format("d");

        $eYear = $eTime->format("Y");
        $eMonth = $eTime->format("m");
        $eDay = $eTime->format("d");

        foreach ($budgets as $budget) {
            $budgetDate= new DateTime($budget->date);
            $budgetYear = $budgetDate->format("Y");
            $budgetMonth = $budgetDate->format("m");


        }



        return 31;
    }
}
