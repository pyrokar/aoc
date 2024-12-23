<?php

declare(strict_types=1);

namespace AOC\Year2016\Day06;

use Generator;
use Safe\Exceptions\ArrayException;
use Override;

class PartTwo
{
    use Solution;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws ArrayException
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
     * @throws ArrayException
     *
     * @return int
     */
    #[Override]
    public function getNeedle(array $charCounts): int
    {
        return \AOC\Util\Safe\min($charCounts);
    }
}
