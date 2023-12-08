<?php

declare(strict_types=1);

namespace AOC\Year2023\Day08;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $steps = 0;

        $nodes = [];

        $instructions = str_split($input->current());
        $l = count($instructions);

        foreach ($input as $line) {
            if (!preg_match('/(?<node>\w+) = \((?<left>\w+), (?<right>\w+)\)/', $line, $m)) {
                continue;
            }

            $nodes[$m['node']] = [
                'L' => $m['left'],
                'R' => $m['right'],
            ];
        }

        $ip = 0;

        $currentNode = 'AAA';

        while ($currentNode !== 'ZZZ') {
            $currentNode = $nodes[$currentNode][$instructions[$ip]];
            $ip = ($ip + 1) % $l;
            ++$steps;
        }

        return $steps;
    }
}
