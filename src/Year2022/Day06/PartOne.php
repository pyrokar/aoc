<?php declare(strict_types=1);

namespace AOC\Year2022\Day06;

use Generator;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $datastream = str_split($input->current());
        $l = count($datastream);

        for ($i = 3; $i < $l; $i++) {
            if (count(array_flip(array_slice($datastream, $i - 3, 4))) === 4) {
                break;
            }
        }

        return $i + 1;
    }
}
