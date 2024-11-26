<?php

declare(strict_types=1);

namespace AOC\Year2019\Day14;

use Generator;
use Safe\Exceptions\ArrayException;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws ArrayException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        [$reactions, $topologicalSort] = $this->processInput($input);

        return $this->calcOre(1, $reactions, $topologicalSort);
    }

}
