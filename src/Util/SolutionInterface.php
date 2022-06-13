<?php declare(strict_types=1);

namespace AOC\Util;

use Generator;

interface SolutionInterface
{
    public function solvePartOne(Generator $input): mixed;
    public function solvePartTwo(Generator $input): mixed;
}
