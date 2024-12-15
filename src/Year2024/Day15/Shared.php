<?php

declare(strict_types=1);

namespace AOC\Year2024\Day15;

use AOC\Util\Position2D;

/**
 * @phpstan-type Move '<'|'>'|'^'|'v'
 */
trait Shared
{
    /**
     * @var array<string, mixed>
     */
    protected array $boxes;

    /**
     * @var array<string, string>
     */
    protected array $walls;
    protected Position2D $robot;


    protected function calcSumGPS(): int
    {
        $sum = 0;
        foreach ($this->boxes as $boxKey => $box) {
            if ($box === ']') {
                continue;
            }

            $boxPos = Position2D::fromKey($boxKey);
            $sum += 100 * $boxPos->y + $boxPos->x;
        }

        return $sum;
    }
}
