<?php

declare(strict_types=1);

namespace AOC\Year2022\Day11;

use Generator;
use Safe\Exceptions\JsonException;
use Safe\Exceptions\PcreException;

class PartTwo
{
    use Util;

    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     * @throws JsonException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        ModuloNumber::clearDivisors();

        $monkeys = $this->inputToMonkeys($input);

        for ($round = 0; $round < 10000; $round++) {
            foreach ($monkeys as $i => $monkey) {
                while ($monkey->hasItems()) {
                    $monkey->inspectAndThrowItem($monkeys);
                }
            }
        }

        usort($monkeys, fn(Monkey $m1, Monkey $m2) => $m2->countInspections <=> $m1->countInspections);

        return $monkeys[0]->countInspections * $monkeys[1]->countInspections;

    }
}
