<?php

declare(strict_types=1);

namespace AOC\Year2024\Day05;

use Generator;
use Safe\Exceptions\PcreException;

use function explode;
use function Safe\preg_match;

final class PartOne
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

        $violatingRules = [];

        foreach ($input as $line) {
            if (preg_match('/(\d+)\|(\d+)/', $line, $m)) {
                $violatingRules[] = '/' . $m[2] . '.+' . $m[1] . '/';
                continue;
            }

            if (preg_match('/((\d+),)+(\d+)/', $line)) {
                foreach ($violatingRules as $rule) {
                    if (preg_match($rule, $line)) {
                        continue 2;
                    }
                }

                $update = explode(',', $line);
                $sum += (int) $update[(int) ((count($update) - 1) / 2)];
            }
        }

        return $sum;
    }
}
