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

    public function testOneMonth()
    {
        $budget = array(
            new Budget('2019/01', 31)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(31, $this->sut->query('2019/01/01', '2019/01/31'));
    }

    public function testOneDay()
    {
        $budget = array(
            new Budget("2019/01", 31)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(1, $this->sut->query('2019/01/01', '2019/01/01'));
    }

    public function testPartOfMonth()
    {
        $budget = array(
            new Budget("2019/01", 31)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(7, $this->sut->query('2019/01/10', '2019/01/16'));
    }

    public function testOneMonthPlusOneDay()
    {
        $budget = array(
            new Budget('2019/01', 31),
            new Budget('2019/02', 28)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(32, $this->sut->query('2019/01/01', '2019/02/01'));
    }

    public function testTwoMonthPlusOneDay()
    {
        $budget = array(
            new Budget('2019/01', 31),
            new Budget('2019/02', 28),
            new Budget('2019/03', 31)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(61, $this->sut->query('2019/01/01', '2019/03/01'));
    }

    public function testCrossMonth()
    {
        $budget = array(
            new Budget("2019/01", 31),
            new Budget("2019/02", 28)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(46, $this->sut->query('2019/01/11', '2019/02/25'));
    }

    public function testHaveNoBudgets()
    {
        $budget = array(
            new Budget("2019/01", 31)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(0, $this->sut->query('2020/01/01', '2020/01/31'));
    }

    public function testStartDateGreaterThanEndDate()
    {
        $budget = array(
            new Budget("2019/01", 31)
        );
        $this->stubFindAllBudgets->shouldReceive('findAllBudgets')->andReturn($budget);
        $this->assertEquals(0, $this->sut->query('2020/01/01', '2019/01/31'));
    }
}
