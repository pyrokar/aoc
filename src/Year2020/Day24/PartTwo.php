<?php

declare(strict_types=1);

namespace AOC\Year2020\Day24;

use AOC\Util\Position2D;
use Generator;

class PartTwo
{
    use Shared;

    /** @var array<string, 1> */
    private array $blackTiles;

    /** @var array<string, 1> */
    private array $whiteTiles = [];

    /**
     * @param Generator<string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->blackTiles = $this->getBlackTilesForInput($input);

        //Position2D::invertY();

        for ($day = 1; $day <= 100; ++$day) {
            $newBlackTiles = [];

            foreach ($this->blackTiles as $blackTileKey => $v) {
                if (!$this->flipBlackTile($blackTileKey)) {
                    $newBlackTiles[$blackTileKey] = 1;
                }
            }

            foreach ($this->whiteTiles as $whiteTileKey => $v) {
                if ($this->flipWhiteTile($whiteTileKey)) {
                    $newBlackTiles[$whiteTileKey] = 1;
                }
            }

            $this->blackTiles = $newBlackTiles;
            $this->whiteTiles = [];
        }

        return count($this->blackTiles);
    }

    private function flipBlackTile(string $key): bool
    {
        $blackNeighborTiles = 0;
        foreach (Position2D::fromKey($key)->getHexagonalNeighborKeys() as $neighborKey) {
            if (isset($this->blackTiles[$neighborKey])) {
                $blackNeighborTiles++;
            } else {
                $this->whiteTiles[$neighborKey] = 1;
            }
        }

        return $blackNeighborTiles === 0 || $blackNeighborTiles > 2;
    }

    private function flipWhiteTile(string $key): bool
    {
        $blackNeighborTiles = 0;
        foreach (Position2D::fromKey($key)->getHexagonalNeighborKeys() as $neighborKey) {
            if (isset($this->blackTiles[$neighborKey])) {
                $blackNeighborTiles++;
            }
        }

        return $blackNeighborTiles === 2;
    }

}
