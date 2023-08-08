<?php

declare(strict_types=1);

namespace AOC\Year2015\Day03;

use AOC\Util\Position2D;
use Generator;

class PartTwo
{
    use Deliver;

    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $santaPosition = new Position2D(0, 0);
        $roboPosition = new Position2D(0, 0);

        $this->grid = [
            $santaPosition->getKey() => 1,
        ];

        array_map_key(function (int $index, string $char) use ($santaPosition, $roboPosition) {
            if ($index % 2 === 1) {
                $this->deliver($santaPosition, $char);
            } else {
                $this->deliver($roboPosition, $char);
            }
        }, str_split($input));

        return count($this->grid);
    }
}
