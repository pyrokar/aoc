<?php

declare(strict_types=1);

namespace AOC\Year2023\Day18;

use function substr;

class PartTwo
{
    use Shared;

    /**
     * @param array{dir: string, dist: string, color: string} $m
     *
     * @return array{int, string}
     */
    public function extract(array $m): array
    {
        static $mapDir = ['0' => 'R', '1' => 'D', '2' => 'L', '3' => 'U'];

        $distance = (int) hexdec(substr($m['color'], 0, 5));
        $dir = $mapDir[substr($m['color'], 5)];

        return [$distance, $dir];
    }
}
