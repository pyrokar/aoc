<?php

declare(strict_types=1);

namespace AOC\Year2024\Day25;

use Generator;

use function str_split;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $locks = [];
        $keys = [];

        $currentHeights = [];
        $isCurrentKey = false;
        $new = true;

        foreach ($input as $line) {

            if (empty($line)) {
                if ($isCurrentKey) {
                    $keys[] = $currentHeights;
                } else {
                    $locks[] = $currentHeights;
                }
                $new = true;
                continue;
            }

            if ($new && $line === '#####') {
                $isCurrentKey = false;
                $currentHeights = [0, 0, 0, 0, 0];
                $new = false;
                continue;
            }

            if ($new && $line === '.....') {
                $isCurrentKey = true;
                $currentHeights = [-1, -1, -1, -1, -1];
                $new = false;
                continue;
            }

            foreach (str_split($line) as $x => $char) {
                if ($char === '#') {
                    ++$currentHeights[$x];
                }
            }
        }

        $fits = 0;

        foreach ($keys as $key) {
            foreach ($locks as $lock) {
                for ($i = 0; $i < 5; $i++) {
                    if ($lock[$i] + $key[$i] > 5) {
                        continue 2;
                    }
                }

                $fits++;
            }
        }

        return $fits;
    }
}
