<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day14;

use AOC\Year2016\Day14\PartOne;
use AOCTest\Util\SolutionTestCase;

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
    public function data(): array
    {
        return [
            [['abc'], 22728],
            [['ngcjuoqr'], 18626],
        ];
    }
}
