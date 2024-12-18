<?php

declare(strict_types=1);

namespace AOC\Year2024\Day18;

use AOC\Util\Position2D;
use AOC\Util\ShortestPath\AStar;

trait Shared
{
    /** @var array<string, string>  */
    protected array $map;

    protected int $width;

    protected int $height;

    /**
     * @param int $width
     * @param int $height
     *
     * @return AStar<string>
     */
    public function init(int $width, int $height): AStar
    {
        Position2D::invertY();

        $this->map = [];
        $this->width = $width;
        $this->height = $height;

        return new AStar(
            function (string $currentKey) {
                $neighbors = [];
                foreach (Position2D::fromKey($currentKey)->getOrthogonalNeighbors() as $neighborPos) {
                    if (isset($this->map[$neighborPos->getKey()])) {
                        continue;
                    }

                    if ($neighborPos->x < 0 || $neighborPos->y < 0 || $neighborPos->x >= $this->width || $neighborPos->y >= $this->height) {
                        continue;
                    }

                    $neighbors[] = $neighborPos->getKey();
                }

                return $neighbors;
            },
            function (string $key, $endKey) {
                return Position2D::fromKey($endKey)->calcManhattanDistanceTo(Position2D::fromKey($key));
            },
        );
    }
}
