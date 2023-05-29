<?php

namespace AOC\Year2015\Day24;

use Generator;

trait Solution
{

    /**
     * @param Generator<int, string, void, void> $input
     * @param int $numberOfGroups
     * @return int
     */
    public function __invoke(Generator $input, int $numberOfGroups): int
    {
        $weights = [];
        $sum = 0;

        foreach ($input as $line) {
            $weight = (int)$line;
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
        $c = [];

        while (true) {
            foreach ($this->getCombinations($weights, $groupSize) as $combination) {
                if (array_sum($combination) !== $groupWeight) {
                    continue;
                }

                $c[] = $combination;

                $qe = array_product($combination);

                $minQE = min($minQE, $qe);
            }

            if (empty($c)) {
                ++$groupSize;
            } else {
                break;
            }
        }

        return (int)$minQE;
    }

    /**
     * @param List<int> $list
     * @param int $length
     * @param int $start
     * @param array $partial
     *
     * @return Generator<int, List<int>>
     */
    protected function getCombinations(array $list, int $length, int $start = 0, array $partial = []): Generator
    {
        if ($length === 1) {
            foreach (array_slice($list, $start) as $el) {
                yield [...$partial, $el];
            }

            return;
        }

        $listLength = count($list);

        foreach (range($start, $listLength - $length) as $i) {
            yield from $this->getCombinations($list, $length - 1, $i + 1, [...$partial, $list[$i]]);
        }
    }
}
