<?php

declare(strict_types=1);

namespace AOC\Year2022\Day17;

use Generator;

class PartOne
{
    use Solution;

    /**
     * @param Generator<string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        return $this->getHeight($input, 2022);
    }

}
