<?php

declare(strict_types=1);

namespace AOC\Year2016\Day09;

use Generator;
use Safe\Exceptions\PcreException;

class PartOne
{
    use Solution;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     *
     */
    public function __invoke(Generator $input): int
    {
        return $this->decompress(trim($input->current()), false);
    }
}
