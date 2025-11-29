<?php

declare(strict_types=1);

namespace AOC\Util;

use Generator;

use const PHP_EOL;

class SpanningRectangle
{
    public Position2D $point0;

    public Position2D $point1;

    private bool $initialized = false;

    public function __construct(
        ?Position2D $point0 = null,
        ?Position2D $point1 = null,
    ) {
        if ($point0) {
            $this->initialize($point0, $point1);
        }
    }

    public function addPoint(Position2D $point): void
    {
        if (!$this->initialized) {
            $this->initialize($point);
            return;
        }

        $this->point0->x = min($this->point0->x, $point->x);
        $this->point0->y = min($this->point0->y, $point->y);

        $this->point1->x = max($this->point1->x, $point->x);
        $this->point1->y = max($this->point1->y, $point->y);
    }

    public function getWidth(): int
    {
        return $this->point1->x - $this->point0->x + 1;
    }

    public function getHeight(): int
    {
        return $this->point1->y - $this->point0->y + 1;
    }

    public function getArea(): int
    {
        return $this->getWidth() * $this->getHeight();
    }

    public function isPositionInside(Position2D $point): bool
    {
        if (!$this->initialized) {
            return false;
        }

        if ($point->x < $this->point0->x || $point->x > $this->point1->x) {
            return false;
        }

        if ($point->y < $this->point0->y || $point->y > $this->point1->y) {
            return false;
        }

        return true;
    }

    public function allPoints(): Generator
    {
        for ($iy = $this->point0->y; $iy <= $this->point1->y; $iy++) {
            for ($ix = $this->point0->x; $ix <= $this->point1->x; $ix++) {
                yield new Position2D($ix, $iy);
            }
        }
    }

    public function print(callable $callback): void
    {
        $lastY = 0;

        foreach ($this->allPoints() as $point) {
            if ($point->y !== $lastY) {
                echo PHP_EOL;
                $lastY = $point->y;
            }

            echo $callback($point);
        }

        echo PHP_EOL;
    }

    private function initialize(Position2D $point0, ?Position2D $point1 = null): void
    {
        $this->initialized = true;

        $this->point0 = clone $point0;
        $this->point1 = clone $this->point0;

        if ($point1) {
            $this->addPoint($point1);
        }
    }
}
