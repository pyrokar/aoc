<?php

declare(strict_types=1);

namespace AOC\Year2020\Day24;

use AOC\Util\HexagonalDirection;
use AOC\Util\Position2D;
use Generator;

trait Shared
{
    /**
     * @param Generator<string> $input
     *
     * @return array<string, 1>
     */
    protected function getBlackTilesForInput(Generator $input): array
    {
        $blackTiles = [];

        foreach ($input as $line) {
            $pos = new Position2D(0, 0);

            for ($i = 0, $c = strlen($line); $i < $c; $i++) {
                $char = $line[$i];
                if ($char === 'e') {
                    $pos->moveHexagonal(HexagonalDirection::East);
                } elseif ($char === 'w') {
                    $pos->moveHexagonal(HexagonalDirection::West);
                } elseif ($char === 's') {
                    if ($line[++$i] === 'w') {
                        $pos->moveHexagonal(HexagonalDirection::SouthWest);
                    } else {
                        $pos->moveHexagonal(HexagonalDirection::SouthEast);
                    }
                } elseif ($char === 'n') {
                    if ($line[++$i] === 'e') {
                        $pos->moveHexagonal(HexagonalDirection::NorthEast);
                    } else {
                        $pos->moveHexagonal(HexagonalDirection::NorthWest);
                    }
                }
            }

            $key = $pos->getKey();
            if (isset($blackTiles[$key])) {
                unset($blackTiles[$key]);
            } else {
                $blackTiles[$key] = 1;
            }
        }
        return $blackTiles;
    }
}
