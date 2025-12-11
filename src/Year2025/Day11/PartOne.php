<?php

declare(strict_types=1);

namespace AOC\Year2025\Day11;

use Generator;
use Safe\Exceptions\PcreException;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->init($input);

        return $this->findPaths('you', 'out');
    }
}
