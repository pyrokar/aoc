<?php
declare(strict_types=1);

namespace AOCTest\Year2015\Day04;

use AOC\Year2015\Day04\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @medium
 */
class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['abcdef'], 609043],
            [['pqrstuv'], 1048970],
            [['bgvyzdsv'], 254575],
        ];
    }
}
