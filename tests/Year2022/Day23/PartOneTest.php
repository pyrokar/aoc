<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day23;

use AOC\Year2022\Day23\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @medium
 */
class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['test'], 25],
            [['test_2'], 110],
            [['input'], 4249],
        ];
    }
}
