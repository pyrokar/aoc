<?php

declare(strict_types=1);

namespace AOC\Year2015\Day24;

use AOC\Util\Set;
use Generator;

trait Solution
{
    /**
     * @param Generator<int, string, void, void> $input
     * @param int $numberOfGroups
     *
     * @return int
     */
    public function __invoke(Generator $input, int $numberOfGroups): int
    {
        $weights = [];
        $sum = 0;

        foreach ($input as $line) {
            $weight = (int) $line;
            $weights[] = $weight;
            $sum += $weight;
        }

        rsort($weights);

        $groupWeight = $sum / $numberOfGroups;

        $groupSize = 2;

        while (true) {
            $sum = array_sum(array_slice($weights, 0, $groupSize));
            if ($sum >= $groupWeight) {
                break;
            }
            ++$groupSize;
        }

        $minQE = INF;
        $combinationFound = false;

        $set = new Set($weights);

        while (true) {
            foreach ($set->getCombinationsOfSize($groupSize) as $combination) {
                if (array_sum($combination) !== $groupWeight) {
                    continue;
                }

                $combinationFound = true;

                $qe = array_product($combination);

                $minQE = min($minQE, $qe);
            }

            if (!$combinationFound) {
                ++$groupSize;
            } else {
                break;
            }
        }

        return (int) $minQE;
    }
}
