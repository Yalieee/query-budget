<?php


namespace Test;

use App\Budget;
use App\FindAllBudgetsInterface;
use App\QueryBudget;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class QueryBudgetTest extends TestCase
{
    /**
     * @var QueryBudget
     */
    private $sut;
    /**
     * @var mock
     */
    private $stubFindAllBudgets;

    public function setUp()
    {
        $this->stubFindAllBudgets = m::mock(FindAllBudgetsInterface::class);
        $this->sut = new QueryBudget($this->stubFindAllBudgets);
        parent::setUp();
    }

    public function testQueryOneMouth()
    {
        $budget = array(
            new Budget("2019/01", 100),
            new Budget("2019/02",200),
            new Budget("2019/03",300)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(31, $this->sut->query('2019/01/01', '2019/01/31'));
    }

    public function testOneMonth()
    {
        $this->assertEquals(31, $this->sut->query('2019/01/01', '2019/01/31'));
    }

    public function testOneDay()
    {
        $this->assertEquals(31, $this->sut->query('2019/01/01', '2019/01/31'));
    }

    public function testCrossMonth()
    {
        $this->assertEquals(31, $this->sut->query('2019/01/01', '2019/01/31'));
    }

    public function testHaveNoBudgets()
    {
        $this->assertEquals(31, $this->sut->query('2019/01/01', '2019/01/31'));
    }

    public function testStartDateGreaterThanEndDate()
    {
        $this->assertEquals(31, $this->sut->query('2019/01/01', '2019/01/31'));
    }
}
