<?php

declare(strict_types=1);

namespace AOC\Year2025\Day04;

use AOC\Util\Position2D;
use Generator;

trait Shared
{
    /**
     * @param Generator<int, string> $input
     *
     * @return array<string, Position2D>
     */
    public function getRolls(Generator $input): array
    {
        $rolls = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === '@') {
                    $pos = new Position2D($x, $y);

                    $rolls[$pos->getKey()] = $pos;
                }
            }
        }

        return $rolls;
    }
}
