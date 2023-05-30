<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day05;

use AOC\Year2015\Day05\PartOne;
use AOC\Test\Util\SolutionTest;

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
            [['ugknbfddgicrmopn'], 1],
            [['aaa'], 1],
            [['jchzalrnumimnmhp'], 0],
            [['haegwjzuvuyypxyu'], 0],
            [['dvszwmarrgswjxmb'], 0],
            [['input.txt'], 255],
        ];
    }
}
