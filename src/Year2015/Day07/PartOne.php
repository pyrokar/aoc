<?php

declare(strict_types=1);

namespace AOC\Year2015\Day07;

use Generator;

class PartOne
{
    use Wires;

    /**
     * @param Generator<int, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->wireInput($input);

        return $this->wires->get('a');
    }
}
