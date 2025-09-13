<?php

declare(strict_types=1);

namespace AOC\Year2016\Day06;

use Generator;
use Safe\Exceptions\ArrayException;
use Override;

use function AOC\Util\Safe\max;

class PartOne
{
    use Solution;

    /**
     * @param Generator<void, non-empty-string, void, void> $input
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
     * @param non-empty-list<int> $charCounts
     *
     * @throws ArrayException
     *
     * @return int
     */
    #[Override]
    public function getNeedle(array $charCounts): int
    {
        return max($charCounts);
    }
}
