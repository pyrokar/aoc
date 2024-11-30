<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day04;

use AOC\Year2019\Day04\PartTwo;
use AOCTest\Util\SolutionTestCase;

final class PartTwoTest extends SolutionTestCase
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
            [[240298, 784956], 748],
        ];
    }
}
