<?php

declare(strict_types=1);

namespace AOC\Year2016\Day19;

class PartTwo
{
    /**
     * @param int $number
     *
     * @return int
     */
    public function __invoke(int $number): int
    {
        $exponent = (int) log($number - 1, 3);
        $threeRaised = 3 ** $exponent;

        return (int) ($number - $threeRaised + floor(($number - $threeRaised - 1) / $threeRaised) * ($number - 2 * $threeRaised));
    }
}
