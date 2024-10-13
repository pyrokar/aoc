<?php

declare(strict_types=1);

namespace AOC\Year2023\Day14;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $platform = [];

        foreach ($input as $y => $line) {
            $platform[$y] = str_split($line);
        }

        $loads = [];

        //$cycles = 1000000000;
        $cycles = 1000;

        for ($i = 0; $i < $cycles; ++$i) {
            for ($r = 0; $r < 4; ++$r) {
                $platform = $this->rollRocks($platform);
                $platform = $this->rotateRight($platform);
            }

            $loads[] = $this->calcLoad($platform);

            $loopAt = $this->detectLoop($loads);
            if (count($loopAt) === 2) {
                return $loopAt[1][(1000000000 - $loopAt[0] - 1) % count($loopAt[1])];
            }
        }

        return -1;
    }

    /**
     * @param array<array<string>> $platform
     *
     * @return array<array<string>>
     */
    private function rotateRight(array $platform): array
    {
        $newPlatform = [];
        $height = count($platform) - 1;

        for ($y = $height; $y >= 0; --$y) {
            foreach ($platform[$y] as $x => $char) {
                $newPlatform[$x][$height - $y] = $char;
            }
        }

        return $newPlatform;
    }

    /**
     * @param array<array<string>> $platform
     *
     * @return int
     */
    private function calcLoad(array $platform): int
    {
        $height = count($platform);
        $load = 0;

        foreach ($platform as $y => $row) {
            foreach ($row as $char) {
                if ($char === 'O') {
                    $load += $height - $y;
                }
            }
        }
        return $load;
    }

    /**
     * not so efficient loop detection ;-)
     *
     * @param array<int> $loads
     *
     * @throws PcreException
     *
     * @return array{} | array{int, array<int>}
     */
    private function detectLoop(array $loads): array
    {
        $size = count($loads);

        if ($size < 7) {
            return [];
        }

        $string = implode(',', $loads);

        for ($offset = 0; $offset < $size - 7; ++$offset) {
            $regex = '/^' . implode(',', array_fill(0, $offset, '\d+'));

            if ($offset > 0) {
                $regex .= ',';
            }

            for ($loopLength = 2; $loopLength < ceil(($size - $offset) / 3); ++$loopLength) {
                $partial = array_slice($loads, $offset, $loopLength);
                $r = $regex . '(' . implode(',', $partial) . ',){3}/';

                if (preg_match($r, $string)) {
                    return [$offset, $partial];
                }
            }
        }

        return [];
    }
}
