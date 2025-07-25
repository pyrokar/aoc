<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day22;

use AOC\Year2015\Day22\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use PHPUnit\Framework\Attributes\Medium;

#[Medium]
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
            [[13, 8, 10, 250], 226],
            [[14, 8, 10, 250], 641],
            [[51, 9, 50, 500], 900],
        ];
    }
}
