<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day19;

use AOC\Year2016\Day19\PartOne;
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
            [[3], 3],
            [[4], 1],
            [[5], 3],
            [[6], 5],
            [[7], 7],
            [[8], 1],
            [[9], 3],
            [[10], 5],
            [[11], 7],
            [[12], 9],
            [[13], 11],
            [[14], 13],
            [[15], 15],
            [[16], 1],
            [[3005290], 1816277],
        ];
    }
}
