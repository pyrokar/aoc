<?php

declare(strict_types=1);

namespace AOC\Year2016\Day22;

use AOC\Util\Point2D;
use AOC\Util\Position2D;
use Generator;
use Safe\Exceptions\PcreException;

/**
 * No solution algorithm, only display the nodes and then count by hand :-D
 * -> bring blank in front of goal node around the barrier and then loop around goal until the finish
 */
class PartTwo
{
    /**
     * @param Generator<int, string> $input
     * @param int $width
     * @param int $height
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input, int $width, int $height): int
    {
        $nodes = [];

        foreach ($input as $line) {
            if (\Safe\preg_match('#/dev/grid/node-x(?<x>\d+)-y(?<y>\d+)\s+(?<size>\d+)T\s+(?<used>\d+)T\s+(?<avail>\d+)T#', $line, $m)) {
                $key = Point2D::key((int) $m['x'], (int) $m['y']);
                $nodes[$key] = [
                    'size' => (int) $m['size'],
                    'used' => (int) $m['used'],
                    'avail' => (int) $m['avail'],
                ];
            }
        }

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $key = Point2D::key($x, $y);

                $currentNode = $nodes[$key];

                $tooLarge = false;
                $p = new Position2D($x, $y);
                foreach ($p->getOrthogonalNeighborKeys() as $neighborKey) {
                    if (!isset($nodes[$neighborKey])) {
                        continue;
                    }

                    if ($currentNode['used'] > $nodes[$neighborKey]['size']) {
                        $tooLarge = true;
                    }
                }

                if ($nodes[$key]['used'] === 0) {
                    echo '_';
                } elseif ($tooLarge) {
                    echo '#';
                } else {
                    echo '.';
                }
            }

            echo PHP_EOL;
        }

        echo PHP_EOL;

        return 0;
    }
}
