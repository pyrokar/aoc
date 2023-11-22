<?php

declare(strict_types=1);

namespace AOC\Year2016\Day14;

class PartTwo
{
    use Solution;

    protected function getHash(string $input): string
    {
        for ($i = 0; $i < 2017; ++$i) {
            $input = md5($input);
        }

        return $input;
    }
}
