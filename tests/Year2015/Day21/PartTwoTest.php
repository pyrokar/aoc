<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day21;

use AOC\Year2015\Day21\PartTwo;
use AOCTest\Util\SolutionTestCase;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[103, 9, 2, 100], 201],
        ];
    }
}
