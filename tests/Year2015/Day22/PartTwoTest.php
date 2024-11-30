<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day22;

use AOC\Year2015\Day22\PartTwo;
use AOCTest\Util\SolutionTestCase;

/**
 * @medium
 */
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
            [[51, 9, 50, 500], 1216],
        ];
    }
}
