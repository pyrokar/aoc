<?php

declare(strict_types=1);

namespace AOC\Year2022\Day12;

use AOC\Util\Pathfinding\AStar;
use AOC\Util\Position2D;
use Exception;
use Generator;

class PartOne extends AStar
{
    use Neighbors;

    /**
     * @param Generator<int, string> $input
     *
     * @throws Exception
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $charToHeight = array_flip(range('a', 'z'));
        $this->heightMap = [];
        $start = null;

        foreach ($input as $y =>  $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === 'S') {
                    $start = new Position2D($x, $y);
                    $char = 'a';
                } elseif ($char === 'E') {
                    $this->setEnd(new Position2D($x, $y));
                    $char = 'z';
                }

                $key = Position2D::key($x, $y);
                $this->heightMap[$key] = $charToHeight[$char];
            }
        }

        if (!$start) {
            throw new Exception();
        }

        return $this->findMinDistance($start);
    }
}
