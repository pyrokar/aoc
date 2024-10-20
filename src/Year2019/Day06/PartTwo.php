<?php

declare(strict_types=1);

namespace AOC\Year2019\Day06;

use AOC\Util\Graph\Graph;
use AOC\Util\ShortestPath\AStar;
use Generator;

use function array_keys;
use function explode;

final class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $graph = new Graph();

        foreach ($input as $line) {
            [$a, $b] = explode(')', $line);

            $graph->addUndirectedEdge($a, $b);
        }

        $astar = new AStar(fn(string $v) => array_keys($graph->getNeighbors($v)), fn(string $a, string $b) => 1);

        return $astar->findMinDistance('YOU', 'SAN') - 2;
    }
}
