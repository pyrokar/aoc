<?php

declare(strict_types=1);

namespace AOC\Year2022\Day09;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;

class Rope
{
    public Position2D $head;

    /**
     * @var array<Position2D>
     */
    public array $knots = [];

    /** @var array{x: array{int, int}, y: array{int, int}}  */
    private array $dimensions = ['x' => [0, 0], 'y' => [0, 0]];

    public function __construct(private readonly int $length = 1)
    {
        $this->head = new Position2D(0, 0);

        for ($i = 0; $i < $length - 1; $i++) {
            $this->knots[] = new Position2D(0, 0);
        }
    }

    public function getTail(): Position2D
    {
        return $this->knots[$this->length - 2];
    }

    public function moveHead(CompassDirection $direction): void
    {
        $this->head->move($direction, 1);

        if ($this->head->x < $this->dimensions['x'][0]) {
            $this->dimensions['x'][0] = $this->head->x;
        } elseif ($this->head->x > $this->dimensions['x'][1]) {
            $this->dimensions['x'][1] = $this->head->x;
        }

        if ($this->head->y < $this->dimensions['y'][0]) {
            $this->dimensions['y'][0] = $this->head->y;
        } elseif ($this->head->y > $this->dimensions['y'][1]) {
            $this->dimensions['y'][1] = $this->head->y;
        }

        $predecessor = $this->head;

        foreach ($this->knots as $knot) {
            $this->followKnot($knot, $predecessor);
            $predecessor = $knot;
        }
    }

    protected function printPath(): void
    {
        for ($y = $this->dimensions['y'][1]; $y >= $this->dimensions['y'][0]; $y--) {
            for ($x = $this->dimensions['x'][0]; $x <= $this->dimensions['x'][1]; $x++) {
                $output = '.';

                $key = Position2D::key($x, $y);
                if ($key === $this->head->getKey()) {
                    $output = 'H';
                } elseif ($x === 0 && $y === 0) {
                    $output = 's';
                } else {
                    foreach ($this->knots as $i => $knot) {
                        if ($key === $knot->getKey()) {
                            $output = (string) ($i + 1);
                            break;
                        }
                    }
                }

                echo $output;
            }

            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

    private function followKnot(Position2D $knot, Position2D $predecessor): void
    {
        $distance = $predecessor->calcManhattanDistanceTo($knot);

        if ($distance < 2 || ($distance === 2 && $predecessor->isDiagonalFrom($knot))) {
            // knot rests at position
            return;
        }

        if ($knot->isOrthogonalFrom($predecessor)) {
            if ($knot->y < $predecessor->y) {
                $knot->move(CompassDirection::North, 1);
            } elseif ($knot->y > $predecessor->y) {
                $knot->move(CompassDirection::South, 1);
            } elseif ($knot->x < $predecessor->x) {
                $knot->move(CompassDirection::East, 1);
            } elseif ($knot->x > $predecessor->x) {
                $knot->move(CompassDirection::West, 1);
            }
        } else {
            if ($knot->x < $predecessor->x && $knot->y < $predecessor->y) {
                $knot->move(CompassDirection::North, 1);
                $knot->move(CompassDirection::East, 1);
            } elseif ($knot->x < $predecessor->x && $knot->y > $predecessor->y) {
                $knot->move(CompassDirection::South, 1);
                $knot->move(CompassDirection::East, 1);
            } elseif ($knot->x > $predecessor->x && $knot->y < $predecessor->y) {
                $knot->move(CompassDirection::North, 1);
                $knot->move(CompassDirection::West, 1);
            } elseif ($knot->x > $predecessor->x && $knot->y > $predecessor->y) {
                $knot->move(CompassDirection::South, 1);
                $knot->move(CompassDirection::West, 1);
            }
        }
    }
}
