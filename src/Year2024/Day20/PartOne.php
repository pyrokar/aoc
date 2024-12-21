<?php

declare(strict_types=1);

namespace AOC\Year2024\Day20;

use AOC\Util\Position2D;
use Generator;

use function abs;

final class PartOne
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

        $cheats = 0;

        foreach ($this->walls as $key => $_) {
            $pos = Position2D::fromKey($key);

            [$p1, $p2] = $pos->getVerticalNeighborKeys();
            if (isset($this->track[$p1], $this->track[$p2])) {
                $save = abs($this->distances[$p1] - $this->distances[$p2]) - 2;
                if ($save >= $minPicoseconds) {
                    $cheats++;
                }

                continue;
            }

            [$p1, $p2] = $pos->getHorizontalNeighborKeys();
            if (isset($this->track[$p1], $this->track[$p2])) {
                $save = abs($this->distances[$p1] - $this->distances[$p2]) - 2;
                if ($save >= $minPicoseconds) {
                    $cheats++;
                }
            }
        }

        return $cheats;
    }
}
