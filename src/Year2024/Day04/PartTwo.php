<?php

declare(strict_types=1);

namespace AOC\Year2024\Day04;

use AOC\Util\Position2D;
use Generator;

use function str_split;

/**
 * @phpstan-type Position array{int, int}
 */
final class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $xmas = 0;

        $mPositions = [];
        $aPositions = [];
        $sPositions = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                $posKey = Position2D::key($x, $y);
                switch ($char) {
                    case 'M': $mPositions[$posKey] = [$x, $y];
                        break;
                    case 'A': $aPositions[$posKey] = [$x, $y];
                        break;
                    case 'S': $sPositions[$posKey] = [$x, $y];
                        break;
                    default: break;
                }
            }
        }

        foreach ($aPositions as $aPos) {

            $neighborKeys = $this->getDiagonalNeighborKeys($aPos);

            if (
                !(isset($mPositions[$neighborKeys[0]], $sPositions[$neighborKeys[2]]))
                && !(isset($sPositions[$neighborKeys[0]], $mPositions[$neighborKeys[2]]))
            ) {
                continue;
            }

            if (
                !(isset($mPositions[$neighborKeys[1]], $sPositions[$neighborKeys[3]]))
                && !(isset($sPositions[$neighborKeys[1]], $mPositions[$neighborKeys[3]]))
            ) {
                continue;
            }

            $xmas++;
        }

        return $xmas;
    }

    /**
     * @param Position $position
     *
     * @return list<string>
     */
    private function getDiagonalNeighborKeys(array $position): array
    {
        return [
            Position2D::key($position[0] - 1, $position[1] - 1),
            Position2D::key($position[0] + 1, $position[1] - 1),
            Position2D::key($position[0] + 1, $position[1] + 1),
            Position2D::key($position[0] - 1, $position[1] + 1),
        ];
    }
}
