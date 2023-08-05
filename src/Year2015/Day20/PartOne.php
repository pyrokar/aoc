<?php

declare(strict_types=1);

namespace AOC\Year2015\Day20;

use Generator;
use Safe\Exceptions\InfoException;
use function Safe\ini_set;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     * @throws InfoException
     */
    public function __invoke(Generator $input): int
    {
        ini_set('memory_limit', '512M');
        $target = ((int) $input->current()) / 10;
        $presents = array_fill(1, $target, 0);

        for ($elf = 1; $elf < $target; ++$elf) {
            for ($house = $elf; $house < $target; $house += $elf) {
                $presents[$house] += $elf;
            }
        }

        foreach($presents as $house => $count) {
            if ($count >= $target) {
                return $house;
            }
        }

        return 0;
    }
}
