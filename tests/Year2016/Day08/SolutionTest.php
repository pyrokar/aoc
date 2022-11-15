<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day08;

use AOC\Year2016\Day08\Solution;
use AOC\Test\Util\TestUtil;
use PHPUnit\Framework\TestCase;

class SolutionTest extends \AOC\Test\Util\SolutionTest #
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
