<?php

namespace AOCTest\Year2016\Day06;

use AOC\Year2016\Day06\PartTwo;

class PartTwoTest extends \AOC\Test\Util\SolutionTest
{
    protected string $solutionClass = PartTwo::class;
    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [['test'], 'advent'],
            [['input'], 'pdesmnoz'],
        ];
    }
}
