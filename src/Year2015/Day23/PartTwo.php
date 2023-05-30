<?php

declare(strict_types=1);

namespace AOC\Year2015\Day23;

use Generator;

class PartTwo
{
    use Solution;

    /**
     * @param Generator<int, string, void, void> $input
     * @param string $register
     *
     * @return int
     */
    public function __invoke(Generator $input, string $register): int
    {
        return $this->getRegisterContent($input, $register, ['a' => 1]);
    }
}
