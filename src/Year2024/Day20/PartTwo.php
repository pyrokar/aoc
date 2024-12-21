<?php

declare(strict_types=1);

namespace AOC\Year2024\Day20;

use AOC\Util\Position2D;
use Generator;

final class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param int $width
     * @param int $height
     * @param int $minPicoseconds
     *
     * @return int
     */
    public function __invoke(Generator $input, int $width, int $height, int $minPicoseconds): int
    {
        $this->init($input, $height, $width);

        $count = 0;

        $trackLength = count($this->track);

        for ($s = 0; $s < $trackLength; $s++) {
            $startKey = $this->trackKeys[$s];
            for ($e = $trackLength - 1; $e >= 0; $e--) {
                if ($s === $e) {
                    break;
                }

                $endKey = $this->trackKeys[$e];

                $d = Position2D::fromKey($startKey)->calcManhattanDistanceTo(Position2D::fromKey($endKey));

                // TODO: not fast enough -> earlier exit?

                if ($d <= 20) {
                    $save = $this->distances[$endKey] - $this->distances[$startKey] - $d;
                    if ($save >= $minPicoseconds) {
                        $count++;
                    }
                }
            }
        }

        return $count;
    }
}
