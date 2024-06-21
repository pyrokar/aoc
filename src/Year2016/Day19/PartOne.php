<?php

declare(strict_types=1);

namespace AOC\Year2016\Day19;

class PartOne
{
    /**
     * @param int $number
     *
     * @return int
     */
    public function __invoke(int $number): int
    {
        $exponent = (int) log($number, 2);

        return ($number - (2 ** $exponent)) * 2 + 1;
    }
}
