<?php

declare(strict_types=1);

namespace AOC\Year2024\Day23;

use Generator;

use function explode;
use function implode;
use function str_starts_with;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $adjacentList = [];
        $setsOfThree = [];
        $edges = [];

        foreach ($input as $line) {
            [$s, $e] = explode('-', $line);

            $edges[] = [$s, $e];

            $adjacentList[$s][$e] = 1;
            $adjacentList[$e][$s] = 1;
        }

        foreach ($edges as [$s, $e]) {
            $v1MustStartWithT = !str_starts_with($s, 't') && !str_starts_with($e, 't');

            foreach ($adjacentList as $v1 => $list) {
                if ($v1 === $s || $v1 === $e) {
                    continue;
                }

                if ($v1MustStartWithT && !str_starts_with($v1, 't')) {
                    continue;
                }

                if (isset($list[$s], $list[$e])) {
                    $arr = [$v1, $s, $e];
                    sort($arr);
                    $key = implode('-', $arr);
                    $setsOfThree[$key] = 1;
                }
            }
        }

        return count($setsOfThree);
    }
}
