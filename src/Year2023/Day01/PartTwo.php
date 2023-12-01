<?php

declare(strict_types=1);

namespace AOC\Year2023\Day01;

use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_replace;

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
        $numberStrings = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
        ];

        $sum = 0;

        foreach ($input as $line) {
            $l = strlen($line);

            $first = 0;
            $firstFound = false;
            $last = 0;
            $lastFound = false;


            for ($i = 0; $i < $l; ++$i) {
                if ($firstFound && $lastFound) {
                    break;
                }

                $first2 = str_replace(array_keys($numberStrings), $numberStrings, substr($line, 0, $i));
                if (strlen($first2) < $i && !$firstFound) {
                    $first = (int) preg_replace('/\D+/', '', $first2);
                    $firstFound = true;
                }

                if (is_numeric($line[$i]) && !$firstFound) {
                    $first = (int) ($line[$i]);
                    $firstFound = true;
                }

                $last2 = str_replace(array_keys($numberStrings), $numberStrings, substr($line, $l - $i));
                if (strlen($last2) < $i && !$lastFound) {
                    $last = (int) preg_replace('/\D+/', '', $last2);
                    $lastFound = true;
                }

                if (is_numeric($line[$l - $i - 1]) && !$lastFound) {
                    $last = (int) ($line[$l - $i - 1]);
                    $lastFound = true;
                }
            }

            $sum += 10 * $first + $last;
        }

        return $sum;
    }
}
