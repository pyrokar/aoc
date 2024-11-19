<?php

declare(strict_types=1);

namespace AOC\Year2019\Day09;

use AOC\Year2019\IntCodeComputer;

use function implode;

final class Solution
{
    /**
     * @param string $code
     *
     * @return string
     */
    public function __invoke(string $code, int $input = 1): string
    {
        $icc = IntCodeComputer::fromString($code);

        $icc->setInput([$input]);

        $icc->execute();

        return implode(',', $icc->getOutput());
    }
}
