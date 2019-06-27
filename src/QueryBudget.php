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
            $budgetDays = cal_days_in_month(CAL_GREGORIAN, $budgetDate->format("m"),
                $budgetDate->format("Y"));


            $countDailyBudget = $budget->value / $budgetDays;
            $amountDate = $this->getDateperiod($startDate, $endDate);

            $money = $countDailyBudget * $amountDate;

            //first month
            if ($sTime == $budgetTime) {
                $lastDateOfmonth = date('Y-m-t', strtotime($startDate));
                $amountDate = $this->getDateperiod($startDate, $lastDateOfmonth);
                $money += $countDailyBudget * $amountDate;
            }
            //last month
            if ($eTime == $budgetTime) {
                $firstDateOfmonth = date('Y-m-01', strtotime($startDate));
                $amountDate = $this->getDateperiod($firstDateOfmonth, $endDate);
                $money += $countDailyBudget * $amountDate;

            }
        }



        return $money;
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $countDailyBudget
     * @return float|int
     */
    public function getDatePeriod($startDate, $endDate)
    {
        $startTimeStamp = strtotime($startDate);
        $endTimeStamp = strtotime($endDate);
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
        $numberDays = $timeDiff / 86400;
        $numberDays = intval($numberDays) + 1;

        return $numberDays;
    }


}
