<?php

declare(strict_types=1);

namespace AOC\Year2019\Day02;

use Generator;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param array<int, int> $overrideMem
     *
     * @return int
     */
    public function __invoke(Generator $input, array $overrideMem = []): int
    {
        $memory = array_map('intval', explode(',', $input->current()));

        $memory = $this->run($memory, $overrideMem);

        return $memory[0];
    }
}
