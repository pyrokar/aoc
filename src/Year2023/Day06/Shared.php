<?php

declare(strict_types=1);

namespace AOC\Year2023\Day06;

trait Shared
{
    /**
     * @param int $time
     * @param int $distance
     *
     * @return int
     */
    private function getOptions(int $time, int $distance): int
    {
        $halfTime = $time / 2;
        $det = sqrt(($time * $time) / 4 - $distance);

        $lowerPoint = (int) ceil($halfTime - $det + 0.0001);
        $upperPoint = (int) floor($halfTime + $det - 0.0001);

        $options = $upperPoint - $lowerPoint + 1;
        return $options;
    }
}
