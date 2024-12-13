<?php

declare(strict_types=1);

namespace AOC\Year2024\Day12;

use AOC\Util\Position2D;
use Generator;

use function count;
use function explode;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        [$map, $newRegions] = $this->init($input);

        $cost = 0;

        foreach ($newRegions as $regionKey => $posKeys) {
            $area = count($posKeys);

            [$char, ] = explode('-', $regionKey);

            $perimeter = 0;

            foreach ($posKeys as $posKey) {

                foreach (Position2D::fromKey($posKey)->getOrthogonalNeighborKeys() as $neighborKey) {
                    if (isset($map[$neighborKey]) && $map[$neighborKey] === $char) {
                        continue;
                    }

                    $perimeter++;
                }
            }

            $cost += $perimeter * $area;
        }

        return $cost;
    }

}
