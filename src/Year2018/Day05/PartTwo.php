<?php

declare(strict_types=1);

namespace AOC\Year2018\Day05;

use function array_unique;
use function str_replace;
use function str_split;
use function strtolower;
use function strtoupper;

use const PHP_INT_MAX;

final class PartTwo
{
    use Shared;

    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $toRemove = array_unique(str_split(strtolower($input)));

        $min = PHP_INT_MAX;

        foreach ($toRemove as $char) {
            $newInput = str_replace([$char, strtoupper($char)], '', $input);

            $min = min($min, $this->react($newInput));
        }

        return $min;
    }
}
