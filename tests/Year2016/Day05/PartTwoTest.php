<?php

namespace AOCTest\Year2016\Day05;

use AOC\Year2016\Day05\PartTwo;

class PartTwoTest extends \AOC\Test\Util\SolutionTest
{

    protected string $solutionClass = PartTwo::class;

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [['abc'], '05ace8e3'],
            [['uqwqemis'], '694190cd'],
        ];
    }
}
