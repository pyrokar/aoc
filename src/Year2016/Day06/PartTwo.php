<?php

declare(strict_types=1);

namespace AOC\Year2016\Day06;

use Generator;

class PartTwo
{
    use Solution;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws \Safe\Exceptions\ArrayException
     *
     * @return string
     */
    public function __invoke(Generator $input): string
    {
        return $this->solve($input);
    }

    /**
     * @param array<int> $charCounts
     *
     * @throws \Safe\Exceptions\ArrayException
     *
     * @return int
     */
    public function getNeedle(array $charCounts): int
    {
        return \AOC\Util\Safe\min($charCounts);
    }
}
