<?php

declare(strict_types=1);

namespace AOC\Year2015\Day20;

use Generator;
use Safe\Exceptions\InfoException;
use function Safe\ini_set;

class PartTwo
{
    /**
     * @param int $input
     * @return int
     * @throws InfoException
     */
    public function __invoke(int $input): int
    {
        ini_set('memory_limit', '2048M');
        $target = $input;
        $presents = array_fill(1, $target, 1);

        for ($elf = 2; $elf < $target; ++$elf) {
            $houseCount = 0;
            for ($house = $elf; $house < $target; $house += $elf) {
                $presents[$house] += $elf;
                if (++$houseCount === 50) {
                    break;
                }
            }
        }

        foreach($presents as $house => $count) {
            if ($count * 11 >= $target) {
                return $house;
            }
        }

        return 0;
    }
}
