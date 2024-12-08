<?php

declare(strict_types=1);

namespace AOC\Year2024\Day08;

use AOC\Util\Position2D;
use Generator;

use function str_split;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     * @param int $width
     * @param int $height
     *
     * @return int
     */
    public function __invoke(Generator $input, int $width, int $height): int
    {
        /** @var array<string, array{int, int}> $antennas */
        $antennas = [];
        $allAntinodes = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === '.') {
                    continue;
                }

                if (!isset($antennas[$char])) {
                    $antennas[$char] = [];
                }

                /** @var array{int, int} $antenna */
                foreach ($antennas[$char] as $antenna) {
                    $v = [$x - $antenna[0], $y - $antenna[1]];

                    $antinodes = [
                        [$antenna[0] - $v[0], $antenna[1] - $v[1]],
                        [$x + $v[0], $y + $v[1]],
                    ];

                    foreach ($antinodes as $antinode) {
                        if ($antinode[0] < 0 || $antinode[0] >= $width || $antinode[1] < 0 || $antinode[1] >= $height) {
                            continue;
                        }

                        $allAntinodes[Position2D::key($antinode[0], $antinode[1])] = $char;
                    }
                }

                $antennas[$char][] = [$x, $y];
            }
        }

        return count($allAntinodes);
    }
}
