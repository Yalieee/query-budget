<?php


namespace App;


class FindAllBudgetsInterface
{
    public function findAllBudgets()
    {
        $budget =  new Budget();
        return array(
            new Budget("2019/01", 100),
            new Budget("2019/02",200),
            new Budget("2019/03",300)
        );
    }
}