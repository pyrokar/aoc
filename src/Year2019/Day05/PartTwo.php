<?php

declare(strict_types=1);

namespace AOC\Year2019\Day05;

use Generator;

use function array_map;
use function explode;

final class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param int $id
     *
     * @return int
     */
    public function __invoke(Generator $input, int $id): int
    {
        $memory = array_map('intval', explode(',', $input->current()));

        return $this->run($memory, $id);
    }
}
