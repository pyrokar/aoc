<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day18;

use AOC\Year2015\Day18\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @large
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
            [['test.txt', 6, 4], 4],
            [['input.txt', 100, 100], 814],
        ];
    }
}
