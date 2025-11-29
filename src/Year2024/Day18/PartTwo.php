<?php

declare(strict_types=1);

namespace AOC\Year2024\Day18;

use AOC\Util\Position2D;
use DomainException;
use Generator;

use function array_map;
use function explode;

final class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param int $width
     * @param int $height
     * @param int $count
     *
     * @return string
     */
    public function __invoke(Generator $input, int $width, int $height, int $count): string
    {
        $pathAlgorithm = $this->init($width, $height);

        $endKey = Position2D::key($width - 1, $height - 1);

        foreach ($input as $i => $line) {
            [$x, $y] = array_map(intval(...), explode(',', $line));
            $this->map[Position2D::key($x, $y)] = '#';

            if ($i >= $count) {

                try {
                    $pathAlgorithm->findMinDistance('0|0', $endKey);
                } catch (DomainException) {
                    return $x . ',' . $y;
                }
            }
        }

        return '';
    }
}
