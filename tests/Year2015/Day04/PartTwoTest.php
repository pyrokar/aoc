<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day04;

use AOC\Year2015\Day04\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;

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
    #[Override]
    public function data(): array
    {
        return [
            [['bgvyzdsv'], 1038736],
        ];
    }
}
