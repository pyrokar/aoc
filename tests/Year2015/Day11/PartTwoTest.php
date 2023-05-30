<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day11;

use AOC\Year2015\Day11\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @large
 */
class PartTwoTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['vzbxkghb'], 'vzbxxyzz'],

            [['vzbxxyzz'], 'vzcaabcc'],
        ];
    }
}
