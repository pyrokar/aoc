<?php

declare(strict_types=1);

namespace AOC\Year2023\Day16;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use DomainException;
use Generator;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->init($input);

        $counts = [];

        for ($x = 0; $x < $this->width; ++$x) {
            $this->sendBeam(new Position2D($x, 0), CompassDirection::South);
            $counts[Position2D::key($x, 0) . CompassDirection::South->value] = count($this->energized);
            $this->reset();

            $this->sendBeam(new Position2D($x, $this->height - 1), CompassDirection::North);
            $counts[Position2D::key($x, $this->height - 1) . CompassDirection::North->value] = count($this->energized);
            $this->reset();
        }

        for ($y = 0; $y < $this->height; ++$y) {
            $this->sendBeam(new Position2D(0, $y), CompassDirection::East);
            $counts[] = count($this->energized);
            $this->reset();

            $this->sendBeam(new Position2D($this->width - 1, $y), CompassDirection::West);
            $counts[] = count($this->energized);
            $this->reset();
        }

        if (empty($counts)) {
            throw new DomainException();
        }

        return max($counts);
    }

    private function reset(): void
    {
        $this->beams = [];
        $this->energized = [];
    }
}
