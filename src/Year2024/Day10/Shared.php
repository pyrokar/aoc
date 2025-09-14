<?php

declare(strict_types=1);

namespace AOC\Year2024\Day10;

use AOC\Util\Position2D;
use Generator;

trait Shared
{
    /** @var array<int, array<string, int>>  */
    protected array $map;

    /**
     * @param Generator $input
     *
     * @return void
     */
    public function init(Generator $input): void
    {
        $this->map = [];

        foreach ($input as $y => $line) {
            foreach (str_split((string) $line) as $x => $char) {
                $key = Position2D::key($x, $y);
                $height = (int) $char;
                $this->map[$height][$key] = $height === 9 ? 1 : -1;
            }
        }
    }
}
