<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day20;

use AOC\Year2015\Day20\PartOne;
use AOCTest\Util\SolutionTestCase;

/**
 * @large
 */
class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[130], 8],
            [[120], 6],
            [[29000000], 665280],
        ];
    }
}
