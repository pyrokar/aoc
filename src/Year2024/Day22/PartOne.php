<?php

declare(strict_types=1);

namespace AOC\Year2024\Day22;

use Generator;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param int $nth
     *
     * @return int
     */
    public function __invoke(Generator $input, int $nth): int
    {
        $sum = 0;

        foreach ($input as $number) {
            $number = (int) $number;

            $sum += $this->generateNthSecret($number, $nth);
        }

        return $sum;
    }

    private function generateNthSecret(int $number, int $nth): int
    {
        for ($i = 1; $i <= $nth; $i++) {
            $number = $this->calcNextNumber($number);
        }

        return $number;
    }
}
