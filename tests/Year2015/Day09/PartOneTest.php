<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day09;

use AOC\Test\Util\SolutionTest;
use AOC\Year2015\Day09\PartOne;

/**
 * @internal
 *
 * @coversNothing
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
            [['test.txt'], 605],
            [['input.txt'], 207],
        ];
    }
}
