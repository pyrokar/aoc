<?php

namespace AOCTest\Year2016\Day05;

use AOC\Year2016\Day05\PartOne;
use AOC\Test\Util\SolutionTest;

class PartOneTest extends SolutionTest
{

    protected string $solutionClass = PartOne::class;
    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [['abc'], '18f47a30'],
            [['uqwqemis'], '1a3099aa'],
        ];
    }
}
