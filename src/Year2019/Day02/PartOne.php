<?php

declare(strict_types=1);

namespace AOC\Year2019\Day02;

use AOC\Year2019\IntCodeComputer;
use Generator;
use Safe\Exceptions\ArrayException;

use function Safe\array_replace;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     * @param array<int, int> $overrideMem
     *
     * @throws ArrayException
     *
     * @return int
     */
    public function __invoke(Generator $input, array $overrideMem = []): int
    {
        $memory = array_map('intval', explode(',', $input->current()));

        $icc = new IntCodeComputer(array_replace($memory, $overrideMem));

        $icc->execute();

        return $icc->getMemory()[0];
    }
}
