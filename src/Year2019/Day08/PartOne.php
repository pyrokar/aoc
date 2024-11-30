<?php

declare(strict_types=1);

namespace AOC\Year2019\Day08;

use function count_chars;
use function str_split;

use const PHP_INT_MAX;

final class PartOne
{
    private const int ZERO = 48;

    private const int ONE = 49;

    private const int TWO = 50;

    /**
     * @param string $input
     * @param positive-int $width
     * @param positive-int $height
     *
     * @return int
     */
    public function __invoke(string $input, int $width, int $height): int
    {
        $layers = str_split($input, $width * $height);

        $fewestZeros = PHP_INT_MAX;
        $result = 0;

        foreach ($layers as $layer) {

            /** @var array<int, int> $counts */
            $counts = count_chars($layer, 1);

            if (!isset($counts[self::ZERO])) {
                continue;
            }

            if ($counts[self::ZERO] >= $fewestZeros) {
                continue;
            }

            $fewestZeros = $counts[self::ZERO];
            $result = $counts[self::ONE] * $counts[self::TWO];
        }

        return $result;
    }
}
