<?php

declare(strict_types=1);

namespace AOC\Year2018\Day01;

use Generator;

use function AOC\Util\reduceInputByLine;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        return reduceInputByLine($input, fn(int $result, string $f) => $result + (int) $f, 0);
    }
}
