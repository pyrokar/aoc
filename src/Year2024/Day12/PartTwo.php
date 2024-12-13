<?php

declare(strict_types=1);

namespace AOC\Year2024\Day12;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

use function count;
use function explode;

final class PartTwo
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

            $fencesTop = [];
            $fencesBottom = [];
            $fencesLeft = [];
            $fencesRight = [];

            foreach ($posKeys as $posKey) {
                $pos = Position2D::fromKey($posKey);
                foreach (CompassDirection::cases() as $direction) {
                    $neighborPos = $pos->getPositionForDirection($direction);
                    $neighborKey = $neighborPos->getKey();

                    if (isset($map[$neighborKey]) && $map[$neighborKey] === $char) {
                        continue;
                    }

                    switch ($direction) {
                        case CompassDirection::North:
                            $fencesTop[$pos->y][] = $pos->x;
                            break;
                        case CompassDirection::South:
                            $fencesBottom[$pos->y][] = $pos->x;
                            break;
                        case CompassDirection::East:
                            $fencesRight[$pos->x][] = $pos->y;
                            break;
                        case CompassDirection::West:
                            $fencesLeft[$pos->x][] = $pos->y;
                            break;
                    }
                }

            }

            $fences = 0;

            foreach ([$fencesTop, $fencesBottom, $fencesLeft, $fencesRight] as $fence) {
                foreach ($fence as $f) {
                    $fences += $this->countFences($f);


                }
            }

            $cost += $area * $fences;

        }

        return $cost;

    }

    /**
     * @param list<int> $numbers
     *
     * @return int
     */
    private function countFences(array $numbers): int
    {
        if (count($numbers) === 1) {
            return 1;
        }

        sort($numbers);

        $count = 1;
        $prev = $numbers[0];
        for ($i = 1, $l = count($numbers); $i < $l; $i++) {
            if ($numbers[$i] - $prev !== 1) {
                $count++;
            }
            $prev = $numbers[$i];
        }

        return $count;
    }
}
