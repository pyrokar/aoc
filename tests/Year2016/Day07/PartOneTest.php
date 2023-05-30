<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day07;

use AOC\Year2016\Day07\PartOne;

class PartOneTest extends \AOC\Test\Util\SolutionTest
{
    protected string $solutionClass = PartOne::class;

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [['test_part1'], 2],
            [['input'], 118],
        ];
    }
}
