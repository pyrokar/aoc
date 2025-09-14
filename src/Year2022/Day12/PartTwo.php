<?php

declare(strict_types=1);

namespace AOC\Year2022\Day12;

use AOC\Util\Pathfinding\AStar;
use AOC\Util\Position2D;
use DomainException;
use Generator;
use Safe\Exceptions\ArrayException;

use function AOC\Util\Safe\min;

class PartTwo extends AStar
{
    use Neighbors;

    /**
     * @param Generator<int, string> $input
     *
     * @throws ArrayException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $charToHeight = array_flip(range('a', 'z'));
        $this->heightMap = [];
        $startPoints = [];

        foreach ($input as $y =>  $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === 'S') {
                    $char = 'a';
                } elseif ($char === 'E') {
                    $this->setEnd(new Position2D($x, $y));
                    $char = 'z';
                }

                if ($char === 'a') {
                    $startPoints[] = new Position2D($x, $y);
                }

                $key = Position2D::key($x, $y);
                $this->heightMap[$key] = $charToHeight[$char];
            }
        }

        $steps = [];

        foreach ($startPoints as $startPoint) {
            try {
                $steps[] = $this->findMinDistance($startPoint);
            } catch (DomainException) {
                continue;
            }
        }

        if (empty($steps)) {
            throw new DomainException();
        }

        return min($steps);
    }
}
