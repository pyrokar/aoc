<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day04;

use AOC\Year2019\Day04\PartOne;
use AOCTest\Util\SolutionTestCase;

final class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;


    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[240298, 784956], 1150],
        ];
    }
}
