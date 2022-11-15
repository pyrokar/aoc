<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day08;

use AOC\Test\Util\SolutionTest;
use AOC\Year2016\Day08\Solution;

class Test extends SolutionTest
{
    protected string $solutionClass = Solution::class;

    public function data(): array
    {
        return [
            [['test', 7, 3], 6],
            [['input', 50, 6], 121],
        ];
    }
}
