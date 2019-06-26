<?php

namespace App;

use App\QueryBudget;
use PHPUnit\Framework\TestCase;

class QueryBudgetTest extends TestCase
{
    public function testQueryOneMouth()
    {
        $budget = new QueryBudget();
        $this->assertEquals(31, $budget->query('2019-01-01', '2019-01-31'));
    }
}
