<?php

declare(strict_types=1);

namespace AOC\Year2016\Day14;

class PartOne
{
    use Solution;

    protected function getHash(string $input): string
    {
        return md5($input);
    }
}
