<?php


namespace App;


class QueryBudget
{
    public function __construct(FindAllBudgetsInterface $findAllBudgets)
    {
        $this->findAllBudgets = $findAllBudgets;
    }

    public function query($startDate, $endDate)
    {
        $budgets = $this->findAllBudgets->findAllBudgets();
        $budgets->setStartDate($startDate);
        $budgets->setEndDate($endDate);
        return 31;
    }
}