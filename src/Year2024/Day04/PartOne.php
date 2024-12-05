<?php

declare(strict_types=1);

namespace AOC\Year2024\Day04;

use AOC\Util\Position2D;
use Generator;

use function array_map;
use function range;
use function str_split;

/**
 * @phpstan-type Position array{int, int}
 * @phpstan-type Vector array{int, int}
 */
final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $xmas = 0;

        $xPositions = [];
        $mPositions = [];
        $aPositions = [];
        $sPositions = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                $posKey = Position2D::key($x, $y);
                switch ($char) {
                    case 'X': $xPositions[] = [$x, $y];
                        break;
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

        foreach ($xPositions as $xPos) {

            foreach ($this->getNeighborVectors() as $vector) {
                $posKeysForDir = $this->getPosKeysForVector($xPos, $vector);

                if (!isset($mPositions[$posKeysForDir[0]])) {
                    continue;
                }
                if (!isset($aPositions[$posKeysForDir[1]])) {
                    continue;
                }
                if (!isset($sPositions[$posKeysForDir[2]])) {
                    continue;
                }

                $xmas++;
            }
        }

        return $xmas;
    }

    /**
     * @param Position $position
     * @param Vector $vector
     *
     * @return list<string>
     */
    private function getPosKeysForVector(array $position, array $vector): array
    {
        return array_map(static fn($distance) => Position2D::key(
            $position[0] + $vector[0] * $distance,
            $position[1] + $vector[1] * $distance,
        ), range(1, 3));
    }

    /**
     * @return list<Vector>
     */
    private function getNeighborVectors(): array
    {
        return [
            [-1, -1],
            [ 0, -1],
            [ 1, -1],
            [-1,  0],
            [ 1,  0],
            [-1,  1],
            [ 0,  1],
            [ 1,  1],
        ];
    }
}
