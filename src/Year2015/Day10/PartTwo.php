<?php

declare(strict_types=1);

namespace AOC\Year2015\Day10;

use Generator;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     * @param int $times
     *
     * @return int
     */
    public function __invoke(Generator $input, int $times): int
    {
        $elements = [array_flip(ConwaysElements::$sequence)[trim($input->current())]];
        $result = [];

        while (0 < $times--) {
            foreach ($elements as $element) {
                array_push($result, ...ConwaysElements::$decaysInto[$element]);
            }

            $elements = $result;
            $result = [];
        }

        $length = 0;
        foreach ($elements as $element) {
            $length += strlen(ConwaysElements::$sequence[$element]);
        }

        return $length;
    }
}