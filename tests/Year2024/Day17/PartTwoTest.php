<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day17;

use AOC\Year2024\Day17\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;

final class PartTwoTest extends SolutionTestCase
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
            //[['0,3,5,4,3,0'], 117440], // wait for generic solution
            [['2,4,1,1,7,5,1,5,4,3,5,5,0,3,3,0'], 164278899142333],
        ];
    }
}
