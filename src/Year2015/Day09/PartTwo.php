<?php

declare(strict_types=1);

namespace AOC\Year2015\Day09;

use AOC\Util\Pathfinding\MaxGraph;
use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $graph = new MaxGraph();

        foreach ($input as $line) {
            if (!preg_match('/(?<source>\w+) to (?<target>\w+) = (?<distance>\d+)/', $line, $m)) {
                continue;
            }

            $source = $m['source'];
            $target = $m['target'];
            $distance = (int) $m['distance'];

            $graph->addEdge($source, $target, $distance);
        }

        return $graph->maxPath();
    }
}
