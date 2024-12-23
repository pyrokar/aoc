<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day25;

use AOC\Year2015\Day25\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;

/**
 * @medium
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
            [[1, 1], 20151125],
            [[2, 1], 31916031],
            [[1, 2], 18749137],
            [[5, 1], 77061],
            [[5, 2], 17552253],
            [[6, 1], 33071741],
            [[6, 2], 6796745],
            [[6, 6], 27995004],
            [[3010, 3019], 8997277],
        ];
    }
}
