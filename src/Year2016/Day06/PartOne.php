<?php

namespace AOC\Year2016\Day06;

use Generator;
use Safe\Exceptions\ArrayException;
use function AOC\Util\Safe\max;

class PartOne
{

    use Solution;

    /**
     * @param Generator<void, string, void, void> $input
     * @return string
     */
    public function __invoke(Generator $input): string
    {
        return $this->solve($input);
    }


    /**
     * @param array<int> $charCounts
     * @return int
     * @throws ArrayException
     */
    public function getNeedle(array $charCounts): int
    {
        return max($charCounts);
    }
}
