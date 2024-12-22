<?php

declare(strict_types=1);

namespace AOC\Year2024\Day22;

trait Shared
{
    /** @var array<int, int> */
    protected array $numberCache;

    protected function calcNextNumber(int $number): int
    {
        if (isset($this->numberCache[$number])) {
            return $this->numberCache[$number];
        }

        $_number = $number;

        $mul = $number * 64;
        $number ^= $mul;
        $number %= 16777216;

        $div = (int) ($number / 32);
        $number ^= $div;
        $number %= 16777216;

        $mul = $number * 2048;
        $number ^= $mul;
        $number %= 16777216;

        $this->numberCache[$_number] = $number;

        return $number;
    }
}
