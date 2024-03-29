<?php

declare(strict_types=1);

namespace AOC\Year2015\Day07;

use Generator;
use Safe\Exceptions\PcreException;

class PartTwo
{
    use Wires;

    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->wireInput($input);

        $a = $this->wires->get('a');

        $this->wires->resetCache();
        $this->wires->set('b', static fn(): int => $a);

        return $this->wires->get('a');
    }
}
