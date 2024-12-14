<?php

declare(strict_types=1);

namespace AOC\Year2024\Day14;

use Generator;
use Safe\Exceptions\PcreException;

use function array_product;
use function Safe\preg_match;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     * @param int $width
     * @param int $height
     * @param int $seconds
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input, int $width, int $height, int $seconds): int
    {
        $quadrants = [0, 0, 0, 0];

        $halfWidth = ($width - 1) / 2;
        $halfHeight = ($height - 1) / 2;

        foreach ($input as $line) {
            if (preg_match("/p=(?<px>\d+),(?<py>\d+) v=(?<vx>-?\d+),(?<vy>-?\d+)/", $line, $m)) {
                $px = (int) $m['px'];
                $py = (int) $m['py'];
                $vx = (int) $m['vx'];
                $vy = (int) $m['vy'];

                $x = ($px + $seconds * $vx) % $width;
                $y = ($py + $seconds * $vy) % $height;

                $x = ($x < 0) ? $x + $width : $x;
                $y = ($y < 0) ? $y + $height : $y;

                if ($x < $halfWidth) {
                    if ($y < $halfHeight) {
                        $quadrants[0]++;
                    } elseif ($y > $halfHeight) {
                        $quadrants[2]++;
                    }
                } elseif ($x > $halfWidth) {
                    if ($y < $halfHeight) {
                        $quadrants[1]++;
                    } elseif ($y > $halfHeight) {
                        $quadrants[3]++;
                    }
                }

            }
        }

        return (int) array_product($quadrants);
    }
}
