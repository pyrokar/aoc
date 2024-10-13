<?php

declare(strict_types=1);

namespace AOC\Year2015\Day02;

use Generator;
use Safe\Exceptions\PcreException;

use function AOC\Util\reduceInputByLine;
use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        return reduceInputByLine($input, function (int $sum, string $line) {

            if (!preg_match('/^(\d+)x(\d+)x(\d+)$/', $line, $matches)) {
                return $sum;
            }

            [, $l, $w, $h] = $matches;

            $sides = [$l * $w, $w * $h, $h * $l];

            return $sum + 2 * array_sum($sides) + min($sides);

        }, 0);
    }
}
