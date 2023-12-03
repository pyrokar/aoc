<?php

declare(strict_types=1);

namespace AOC\Year2023\Day03;

use Generator;

class PartTwo
{
    /**
     * @param Generator<string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        $secondLastRowNumbers = [];
        $lastRowGears = [];
        $lastRowNumbers = [];

        foreach ($input as $line) {
            $chars = str_split($line);

            $currentRowNumbers = [];
            $currentRowGears = [];

            for ($x = 0, $l = count($chars); $x < $l; ++$x) {
                $char = $chars[$x];
                if ($char === '.') {
                    continue;
                }

                if (is_numeric($char)) {
                    $number = (int) substr($line, $x);
                    $currentRowNumbers[$x] = $number;
                    $x += strlen((string) $number) - 1;
                    continue;
                }

                if ($char === '*') {
                    $currentRowGears[$x] = $char;
                }
            }

            foreach ($lastRowGears as $gearX => $gear) {
                $adjacentNumbers = [];

                for ($i = $gearX - 3; $i <= $gearX + 1; ++$i) {
                    // top row
                    if (isset($secondLastRowNumbers[$i]) && ($i + strlen((string) $secondLastRowNumbers[$i])) > $gearX - 1) {
                        $adjacentNumbers[] = $secondLastRowNumbers[$i];
                    }

                    // same row
                    if (isset($lastRowNumbers[$i]) && ($i + strlen((string) $lastRowNumbers[$i])) > $gearX - 1) {
                        $adjacentNumbers[] = $lastRowNumbers[$i];
                    }

                    // bottom row
                    if (isset($currentRowNumbers[$i]) && ($i + strlen((string) $currentRowNumbers[$i])) > $gearX - 1) {
                        $adjacentNumbers[] = $currentRowNumbers[$i];
                    }
                }

                if (count($adjacentNumbers) === 2) {
                    $sum += (int) array_product($adjacentNumbers);
                }
            }

            $secondLastRowNumbers = $lastRowNumbers;

            $lastRowNumbers = $currentRowNumbers;
            $lastRowGears = $currentRowGears;
        }

        return $sum;
    }
}
