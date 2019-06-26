<?php


namespace App;

use PHPUnit\Framework\TestCase;

class QueryBudgetTest extends TestCase
{
    private $sut;

    public function setUp()
    {
        $this->sut = new QueryBudget($findAllBudgets);
        parent::setUp();
    }

    public function testQueryOneMouth()
    {
        $this->assertEquals(31, $this->sut->query('2019-01-01', '2019-01-31'));
    }

    public function testOneMonth()
    {
        $this->assertEquals(31, $sut->query('2019-01-01', '2019-01-31'));
    }

    public function testOneDay()
    {
        $this->assertEquals(31, $sut->query('2019-01-01', '2019-01-31'));
    }

    public function testCrossMonth()
    {
        $this->assertEquals(31, $sut->query('2019-01-01', '2019-01-31'));
    }

    public function testHaveNoBudgets()
    {
        $this->assertEquals(31, $sut->query('2019-01-01', '2019-01-31'));
    }

    public function testStartDateGreaterThanEndDate()
    {
        $this->assertEquals(31, $sut->query('2019-01-01', '2019-01-31'));
    }
}
