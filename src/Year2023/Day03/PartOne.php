<?php

declare(strict_types=1);

namespace AOC\Year2023\Day03;

use Generator;

class PartOne
{
    /**
     * @param Generator<string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        $lastRowSymbols = [];
        $lastRowNumbers = [];

        foreach ($input as $line) {
            $chars = str_split($line);

            $currentRowNumbers = [];
            $currentRowSymbols = [];

            for ($x = 0, $l = count($chars); $x < $l; ++$x) {
                $char = $chars[$x];
                if ($char === '.') {
                    continue;
                }

                if (is_numeric($char)) {
                    $number = (int) substr($line, $x);
                    $numberLength = strlen((string) $number);
                    if ($x > 0 && $chars[$x - 1] !== '.') {
                        // symbol left
                        $sum += $number;
                        $x += $numberLength - 1;
                        continue;
                    }

                    if ($x + $numberLength < $l && $chars[$x + $numberLength] !== '.') {
                        // symbol right
                        $sum += $number;
                        $x += $numberLength - 1;
                        continue;
                    }

                    $start = $x > 0 ? $x - 1 : 0;
                    $end = $x + $numberLength < $l ? $x + $numberLength : $l - 1;

                    for ($i = $start; $i <= $end; ++$i) {
                        if (isset($lastRowSymbols[$i])) {
                            $sum += $number;
                            $x += $numberLength;
                            continue 2;
                        }
                    }

                    $currentRowNumbers[$x] = $number;

                    $x += $numberLength;
                    continue;
                }

                // $char is symbol
                $currentRowSymbols[$x] = $char;
                foreach ($lastRowNumbers as $i => $number) {
                    $numberLength = strlen((string) $number);
                    /** @phpstan-ignore-next-line */
                    if ($x <= ($i + $numberLength) && $x >= ($i - 1)) {
                        // adjacent number found
                        $sum += $number;
                        unset($lastRowNumbers[$i]);
                    }
                }
            }

            $lastRowNumbers = $currentRowNumbers;
            $lastRowSymbols = $currentRowSymbols;
        }

        return $sum;
    }
}
