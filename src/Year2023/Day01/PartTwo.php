<?php

declare(strict_types=1);

namespace AOC\Year2023\Day01;

use Generator;

use Safe\Exceptions\PcreException;

class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $numberStrings = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',];

        $sum = 0;

        foreach ($input as $line) {
            $l = strlen($line);

            $numbers = [];

            for ($i = 0; $i < $l; ++$i) {
                if (is_numeric($line[$i])) {
                    $numbers[] = (int) ($line[$i]);
                    continue;
                }

                $substr = substr($line, $i);

                foreach ($numberStrings as $number => $string) {
                    if (str_starts_with($substr, $string)) {
                        $numbers[] = $number + 1;
                    }
                }
            }

            $sum += 10 * $numbers[0] + array_pop($numbers);
        }

        return $sum;
    }
}
