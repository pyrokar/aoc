<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day21;

use AOC\Year2015\Day21\PartOne;
use AOCTest\Util\SolutionTestCase;

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
            [[12, 7, 2, 8], 65],
            [[103, 9, 2, 100], 121],
        ];
    }
}
