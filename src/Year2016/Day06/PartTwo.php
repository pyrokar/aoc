<?php declare(strict_types=1);

namespace AOC\Year2016\Day06;

use Generator;

class PartTwo
{
    use Solution;

    /**
     * @param Generator<void, string, void, void> $input
     * @return string
     * @throws \Safe\Exceptions\ArrayException
     */
    public function __invoke(Generator $input): string
    {
        return $this->solve($input);
    }

    /**
     * @param array<int> $charCounts
     * @return int
     * @throws \Safe\Exceptions\ArrayException
     */
    public function getNeedle(array $charCounts): int
    {
        return \AOC\Util\Safe\min($charCounts);
    }
}
