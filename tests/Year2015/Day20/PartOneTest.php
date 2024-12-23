<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day20;

use AOC\Year2015\Day20\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;

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
    #[Override]
    public function data(): array
    {
        return [
            [[130], 8],
            [[120], 6],
            [[29000000], 665280],
        ];
    }
}
