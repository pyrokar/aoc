<?php

declare(strict_types=1);

namespace AOC\Year2018\Day01;

use Generator;

use function iterator_to_array;

final class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $changes = iterator_to_array($input);

        $frequencies = [0 => 1];

        $currentFrequency = 0;

        while (true) {
            foreach ($changes as $change) {
                $currentFrequency += (int) $change;

                if (isset($frequencies[$currentFrequency])) {
                    return $currentFrequency;
                }

                $frequencies[$currentFrequency] = 1;
            }

            reset($changes);
        }
    }
}
