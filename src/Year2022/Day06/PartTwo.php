<?php

declare(strict_types=1);

namespace AOC\Year2022\Day06;

use Generator;

class PartTwo
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $datastream = str_split($input->current());
        $l = count($datastream);

        for ($i = 13; $i < $l; $i++) {
            if (count(array_flip(array_slice($datastream, $i - 13, 14))) === 14) {
                break;
            }
        }

        return $i + 1;
    }
}
