<?php

declare(strict_types=1);

namespace AOC\Year2024\Day05;

use Generator;
use Safe\Exceptions\PcreException;

use function count;
use function explode;
use function Safe\preg_match;

final class PartTwo
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
        $rules = [];

        foreach ($input as $line) {
            if (preg_match('/(\d+)\|(\d+)/', $line, $m)) {
                $violatingRules[] = '/' . $m[2] . '.+' . $m[1] . '/';
                $rules[$line] = 1;
                continue;
            }

            if (preg_match('/((\d+),)+(\d+)/', $line)) {
                foreach ($violatingRules as $rule) {
                    if (preg_match($rule, $line)) {
                        $update = explode(',', $line);

                        usort($update, static fn($a, $b) => match (true) {
                            isset($rules[$a . '|' . $b]) => -1,
                            isset($rules[$b . '|' . $a]) => 1,
                            default => 0,
                        });

                        $sum += (int) $update[(count($update) - 1) / 2];

                        continue 2;
                    }
                }
            }
        }

        return $sum;
    }
}
