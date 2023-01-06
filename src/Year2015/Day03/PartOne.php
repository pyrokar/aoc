<?php
declare(strict_types=1);

namespace AOC\Year2015\Day03;

use AOC\Util\Position2D;
use Generator;

class PartOne
{
    use Deliver;

    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $santaPosition = new Position2D(0, 0);

        $this->grid = [
            $santaPosition->getKey() => 1,
        ];

        array_map(function (string $char) use ($santaPosition) {
            $this->deliver($santaPosition, $char);
        }, str_split($input->current()));

        return count($this->grid);
    }
}
