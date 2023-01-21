<?php
declare(strict_types=1);

namespace AOC\Year2022\Day17;

use Generator;

class PartTwo
{
    use Solution;

    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        return $this->getHeight($input, 1000000000000);
    }
}
