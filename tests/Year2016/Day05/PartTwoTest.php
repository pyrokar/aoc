<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day05;

use AOC\Test\Util\SolutionTest;
use AOC\Year2016\Day05\PartTwo;

/**
 * @large
 */
class PartTwoTest extends SolutionTest
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
