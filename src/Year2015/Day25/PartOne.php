<?php

declare(strict_types=1);

namespace AOC\Year2015\Day25;

class PartOne
{
    /**
     * @param int $row
     * @param int $column
     *
     * @return int
     */
    public function __invoke(int $row, int $column): int
    {
        $target = $this->calcIndex($row, $column);

        $value = 20151125;

        for ($i = 1; $i < $target; ++$i) {
            $value = ($value * 252533) % 33554393;
        }

        return $value;
    }

    private function calcIndex(int $row, int $column): int
    {
        return (($row - 1) * $row) / 2 + ($column * ($column + 1)) / 2 + ($row - 1) * ($column - 1);
    }
}
