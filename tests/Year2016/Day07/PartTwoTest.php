<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day07;

use AOC\Year2016\Day07\PartTwo;

class PartTwoTest extends \AOC\Test\Util\SolutionTest
{
    protected string $solutionClass = PartTwo::class;

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [['test_part2'], 3],
            [['input'], 260],
        ];
    }
}
