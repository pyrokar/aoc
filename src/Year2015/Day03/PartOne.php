<?php

declare(strict_types=1);

namespace AOC\Year2015\Day03;

use AOC\Util\Position2D;

class PartOne
{
    use Deliver;

    /**
     * @param string $input
     * @return int
     */
    public function __invoke(string $input): int
    {
        $santaPosition = new Position2D(0, 0);

        $this->grid = [
            $santaPosition->getKey() => 1,
        ];

        array_map(function (string $char) use ($santaPosition) {
            $this->deliver($santaPosition, $char);
        }, str_split($input));

        return count($this->grid);
    }
}
