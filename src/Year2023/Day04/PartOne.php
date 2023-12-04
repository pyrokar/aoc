<?php

declare(strict_types=1);

namespace AOC\Year2023\Day04;

use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;
use function Safe\preg_replace;

class PartOne
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
        $sum = 0;

        foreach ($input as $line) {
            if (!preg_match('/Card \d+: (?<numbers>.*)/', preg_replace('/\s{2,}/', ' ', $line), $m)) {
                continue;
            }

            [$w, $my] = explode(' | ', $m['numbers']);

            $win = array_flip(explode(' ', $w));

            $my = explode(' ', $my);

            $points = 0;

            foreach ($my as $number) {
                if (isset($win[$number])) {
                    if ($points === 0) {
                        $points = 1;
                    } else {
                        $points *= 2;
                    }
                }
            }

            $sum += $points;

        }

        return $sum;
    }
}
