<?php

declare(strict_types=1);

namespace AOC\Year2024\Day06;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

trait Shared
{
    /**
     * @var array<string, array<string, int>>
     */
    protected array $path;

    /**
     * @var array<string, int>
     */
    protected array $obstructions;

    /**
     * @var array<string, int>
     */
    protected array $free;

    protected Position2D $startPosition;

    /**
     * @param Generator $input
     */
    public function init(Generator $input): void
    {
        $this->path = [];
        $this->obstructions = [];
        $this->free = [];

        foreach ($input as $y => $line) {
            foreach (str_split((string) $line) as $x => $char) {
                $posKey = Position2D::key($x, $y);
                switch ($char) {
                    case '.':
                        $this->free[$posKey] = 1;
                        break;
                    case '#':
                        $this->obstructions[$posKey] = 1;
                        break;
                    case '^':
                        $this->startPosition = Position2D::fromKey($posKey);
                        $this->free[$posKey] = 1;
                        $this->path[$posKey] = [CompassDirection::North->value => 1];
                        break;
                }
            }
        }
    }

    /**
     * @param array<string, int> $obstructions
     * @param array<string, int> $free
     *
     * @return array{array<string, array<string, int>>, bool}
     */
    protected function getPath(array $obstructions, array $free): array
    {
        $currentPosition = clone $this->startPosition;

        $hasLoop = false;

        $direction = CompassDirection::North;
        $path = $this->path;

        while (true) {
            $nextPos = $currentPosition->getPositionForDirection($direction);

            if (isset($obstructions[$nextPos->getKey()])) {
                $direction = $direction->turnRight();
                continue;
            }

            if (!isset($free[$nextPos->getKey()])) {
                break;
            }

            $currentPosition->move($direction, 1);
            $currentPosKey = $currentPosition->getKey();
            if (isset($path[$currentPosKey][$direction->value])) {
                $hasLoop = true;
                break;
            }

            $path[$currentPosKey][$direction->value] = 1;

        }

        return [$path, $hasLoop];
    }
}
