<?php

declare(strict_types=1);

namespace AOC\Year2022\Day11;

use AOC\Util\Display2D;
use Generator;

use Safe\Exceptions\JsonException;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    use Util;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     * @throws JsonException
     *
     * @return string
     */
    public function __invoke(Generator $input): int
    {
        ModuloNumber::clearDivisors();

        $monkeys = $this->inputToMonkeys($input);

        for ($round = 0; $round < 10000; $round++) {
            foreach ($monkeys as $i => $monkey) {
                // echo 'Monkey ' . $i . ':' . PHP_EOL;
                while ($monkey->hasItems()) {
                    $monkey->inspectAndThrowItem($monkeys);
                }
            }
        }

        usort($monkeys, fn (Monkey $m1, Monkey $m2) => $m2->countInspections <=> $m1->countInspections);

        return $monkeys[0]->countInspections * $monkeys[1]->countInspections;

    }
}
