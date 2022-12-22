<?php

namespace AOC\Util;

class Grid2D
{
    /**
     * @var array<string, Position2D>
     */
    private array $positions;

    /**
     * @var array<int, array<int, Position2D>>
     */
    private array $columns;

    /**
     * @var array<int, array<int, Position2D>>
     */
    private array $rows;

    /**
     */
    public function __construct(

    ) {
        $this->positions = [];
        $this->columns = [];
        $this->rows = [];
    }

    public function insert(Position2D $position2D): void
    {
        $key = $position2D->getKey();
        $this->positions[$key] = $position2D;

        $x = $position2D->x;
        $y = $position2D->y;

        if (!isset($this->columns[$x])) {
            $this->columns[$x] = [];
        }
        $this->columns[$x][$y] = $position2D;

        if (!isset($this->rows[$y])) {
            $this->rows[$y] = [];
        }
        $this->columns[$y][$x] = $position2D;
    }

    public function get(string $key): Position2D
    {
        return $this->positions[$key];
    }
}
