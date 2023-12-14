<?php

declare(strict_types=1);

namespace AOC\Year2023\Day14;

use Generator;

class PartOne
{
    use Shared;
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $platform = [];

        foreach ($input as $y => $line) {
            $platform[$y] = str_split($line);
        }

        $platform = $this->rollRocks($platform);

        $height = count($platform);
        $load = 0;

        foreach ($platform as $y => $row) {
            foreach ($row as $char) {
                if ($char === 'O') {
                    $load += $height - $y;
                }
            }
        }

        return $load;
    }

}
