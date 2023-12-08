<?php

declare(strict_types=1);

namespace AOC\Year2023\Day08;

use Generator;
use Safe\Exceptions\PcreException;

use function AOC\Util\Math\leastCommonMultiple;
use function Safe\preg_match;

class PartTwo
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
        $nodes = [];

        $currentNodes = [];
        $endNodes = [];

        $instructions = str_split($input->current());
        $l = count($instructions);

        foreach ($input as $line) {
            if (!preg_match('/(?<node>\w+) = \((?<left>\w+), (?<right>\w+)\)/', $line, $m)) {
                continue;
            }

            $node = $m['node'];

            $nodes[$node] = [
                'L' => $m['left'],
                'R' => $m['right'],
            ];

            if (preg_match('/..A/', $node)) {
                $currentNodes[] = $node;
            }

            if (preg_match('/..Z/', $node)) {
                $endNodes[$node] = 1;
            }

        }

        $stepsTotal = 1;

        foreach ($currentNodes as $currentNode) {
            $ip = 0;
            $steps = 0;
            $endNodeReached = false;

            while (!$endNodeReached) {
                $currentNode = $nodes[$currentNode][$instructions[$ip]];
                if (isset($endNodes[$currentNode])) {
                    $endNodeReached = true;
                }
                $ip = ($ip + 1) % $l;
                ++$steps;
            }

            $stepsTotal = leastCommonMultiple($stepsTotal, $steps);
        }

        return $stepsTotal;
    }
}
