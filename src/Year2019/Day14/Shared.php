<?php

declare(strict_types=1);

namespace AOC\Year2019\Day14;

use Generator;

/**
 * @phpstan-type Reactions array<string, array<string, array{int, int}>>
 */
trait Shared
{
    /**
     * @param int $fuel
     * @param Reactions $reactions
     * @param array<string> $topologicalSort
     *
     * @return int
     */
    protected function calcOre(int $fuel, array $reactions, array $topologicalSort): int
    {
        foreach ($reactions['FUEL'] as &$amounts) {
            $amounts[0] = $fuel;
            $amounts[1] *= $fuel;
        }

        unset($amounts);

        while (true) {

            foreach ($topologicalSort as $in) {
                if (!isset($reactions['FUEL'][$in])) {
                    continue;
                }

                $inAmounts = $reactions['FUEL'][$in];

                foreach ($reactions[$in] as $out => $outAmounts) {

                    $newAmount = ceil($inAmounts[1] / $outAmounts[0]) * $outAmounts[1];

                    unset($reactions['FUEL'][$in]);

                    if (isset($reactions['FUEL'][$out])) {
                        $reactions['FUEL'][$out][1] += $newAmount;
                    } else {
                        $reactions['FUEL'][$out] = [$inAmounts[0], $newAmount];
                    }
                }
            }

            if (count($reactions['FUEL']) === 1 && isset($reactions['FUEL']['ORE'])) {
                break;
            }

        }

        return (int) $reactions['FUEL']['ORE'][1];
    }

    /**
     * @param Generator $input
     *
     * @return array{Reactions, array<string>}
     */
    protected function processInput(Generator $input): array
    {
        $reactions = [];
        $distancesFromOre = ['ORE' => 0];

        foreach ($input as $line) {
            [$in, $out] = explode(' => ', (string) $line);

            $out = explode(' ', $out);

            $in = explode(', ', $in);

            foreach ($in as $i) {
                $ii = explode(' ', $i);

                $reactions[$out[1]][$ii[1]] = [(int) $out[0], (int) $ii[0]];

                if (isset($distancesFromOre[$ii[1]])) {
                    if (isset($distancesFromOre[$out[1]])) {
                        $distancesFromOre[$out[1]] = max([$distancesFromOre[$out[1]], $distancesFromOre[$ii[1]] + 1]);
                    } else {
                        $distancesFromOre[$out[1]] = $distancesFromOre[$ii[1]] + 1;
                    }
                }
            }
        }

        do {
            $change = false;
            foreach ($reactions as $node => $resources) {
                foreach (array_keys($resources) as $resource) {
                    if (!isset($distancesFromOre[$node])) {
                        $distancesFromOre[$node] = ($distancesFromOre[$resource] ?? 0) + 1;
                        $change = true;
                    } elseif ($distancesFromOre[$node] < ($distancesFromOre[$resource] ?? 0) + 1) {
                        $distancesFromOre[$node] = ($distancesFromOre[$resource] ?? 0) + 1;
                        $change = true;
                    }
                }
            }
        } while ($change);

        arsort($distancesFromOre);
        unset($distancesFromOre['ORE'], $distancesFromOre['FUEL']);
        $topologicalSort = array_keys($distancesFromOre);

        return [$reactions, $topologicalSort];
    }
}
