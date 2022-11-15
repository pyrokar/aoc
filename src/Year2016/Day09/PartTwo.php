<?php declare(strict_types=1);

namespace AOC\Year2016\Day09;

use Generator;
use Safe\Exceptions\PcreException;

class PartTwo
{
    use Solution;

    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     *
     * @throws PcreException
     */
    public function __invoke(Generator $input): int
    {
        return $this->decompress(trim($input->current()), true);
    }
}
