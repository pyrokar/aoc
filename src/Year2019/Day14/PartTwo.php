<?php

declare(strict_types=1);

namespace AOC\Year2019\Day14;

use AOC\Util\BinarySearch;
use Generator;

use function ceil;

final class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        [$reactions, $topologicalSort] = $this->processInput($input);

        $targetOre = 1000000000000;

        $ore = $this->calcOre(1, $reactions, $topologicalSort);

        $tempFuel = (int) ceil($targetOre / $ore);

        $binSearch = new BinarySearch($tempFuel, $tempFuel * 3);

        $fuel = 1;

        foreach ($binSearch->next() as $fuel) {
            $o = $this->calcOre($fuel, $reactions, $topologicalSort);

            if ($o < $targetOre) {
                $binSearch->setLower(false);
            } else {
                $binSearch->setLower(true);
            }
        }

        return $fuel;
    }
}
