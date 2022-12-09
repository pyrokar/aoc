<?php

namespace AOC\Year2022\Day09;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;

class Rope
{
    public Position2D $head;
    public Position2D $tail;

    /**
     * @var array<Position2D>
     */
    public array $knots = [];

    public function __construct(int $length = 2)
    {
        $this->head = new Position2D(0, 0);

        for ($i = 0; $i < $length - 2; $i++) {
            $this->knots[] = new Position2D(0, 0);
        }

        $this->tail = new Position2D(0, 0);
    }

    public function moveHead(CompassDirection $direction): void
    {
        $this->head->move($direction, 1);

        $predecessor = $this->head;

        foreach ($this->knots as $knot) {
            $this->followKnot($knot, $predecessor, $direction);
            $predecessor = $knot;
        }

        $this->followKnot($this->tail, $predecessor, $direction);
    }

    private function followKnot(Position2D $knot, Position2D $predecessor, CompassDirection $direction): void
    {
        $distance = $predecessor->calcManhattanDistanceTo($knot);

        if ($distance < 2 || ($distance === 2 && $predecessor->isDiagonalFrom($knot))) {
            // knot rests at position
            return;
        }

        $tailTmp = clone $knot;

        $knot->move($direction, 1);

        if ($predecessor->isDiagonalFrom($tailTmp)) {
            if ($knot->x > $predecessor->x && $direction !== CompassDirection::West) {
                $knot->move(CompassDirection::West, 1);
            } elseif ($knot->x < $predecessor->x && $direction !== CompassDirection::East) {
                $knot->move(CompassDirection::East, 1);
            } elseif ($knot->y > $predecessor->y && $direction !== CompassDirection::South) {
                $knot->move(CompassDirection::South, 1);
            } elseif ($knot->y < $predecessor->y && $direction !== CompassDirection::North) {
                $knot->move(CompassDirection::North, 1);
            }
        }
    }

}
