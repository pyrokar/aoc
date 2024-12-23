<?php

declare(strict_types=1);

namespace AOC\Year2024\Day23;

use Generator;

use function array_intersect_assoc;
use function array_keys;
use function array_pop;
use function explode;
use function implode;
use function uasort;

final class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @return string
     */
    public function __invoke(Generator $input): string
    {
        $adjacentList = [];
        $sets = [];
        $edges = [];

        foreach ($input as $line) {
            [$s, $e] = explode('-', $line);

            $edges[] = [$s, $e];
            $sets[] = [$s => 1, $e => 1];

            $adjacentList[$s][$e] = 1;
            $adjacentList[$e][$s] = 1;

        }

        foreach ($edges as [$v1, $v2]) {
            foreach ($sets as &$set) {
                if (isset($set[$v1]) && !isset($set[$v2])) {
                    $a = array_intersect_assoc($set, $adjacentList[$v2]);

                    if ($set !== $a) {
                        continue;
                    }

                    $set[$v2] = 1;
                }

                if (isset($set[$v2]) && !isset($set[$v1])) {
                    $a = array_intersect_assoc($set, $adjacentList[$v1]);

                    if ($set !== $a) {
                        continue;
                    }

                    $set[$v1] = 1;
                }
            }
            unset($set);
        }

        uasort($sets, function ($a, $b) {
            return count($a) <=> count($b);
        });

        $maxSet = array_pop($sets) ?? [];
        ksort($maxSet);

        return implode(',', array_keys($maxSet));
    }
}
