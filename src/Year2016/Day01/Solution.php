<?php declare(strict_types=1);

namespace AOC\Year2016\Day01;

use AOC\Util\CompassDirection;
use AOC\Util\Point2D;
use AOC\Util\Position2D;
use AOC\Util\SolutionInterface;
use AOC\Util\SolutionUtil;
use Exception;
use Generator;
use Safe\Exceptions\PcreException;
use function Safe\preg_match;

class Solution implements SolutionInterface
{
    use SolutionUtil;

    private CompassDirection $direction;
    private Position2D $position;

    public function __construct()
    {
        $this->direction = CompassDirection::North;
    }


    /**
     * @param Generator<string> $input
     *
     * @return int
     * @throws Exception
     *
     * @throws PcreException
     */
    public function solvePartOne(Generator $input): int
    {
        $this->position = new Position2D(0, 0);

        $directions = explode(', ', $input->current());

        foreach ($directions as $direction) {
            preg_match('/([LR])(\d+)/', $direction, $m);

            $this->direction = match ($m[1]) {
                'L' => $this->direction->turnLeft(),
                'R' => $this->direction->turnRight(),
                default => throw new Exception(),
            };

            $this->position->move($this->direction, (int) $m[2]);
        }

        return $this->position->calcManhattanDistanceTo(new Point2D(0, 0));
    }

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     * @throws Exception
     *
     * @return int
     */
    public function solvePartTwo(Generator $input): int
    {
        $this->position = new Position2D(0, 0);
        $path = [Point2D::key(0, 0)];

        $directions = explode(', ', (string) $input->current());

        foreach ($directions as $direction) {
            preg_match('/([LR])(\d+)/', $direction, $m);

            $this->direction = match ($m[1]) {
                'L' => $this->direction->turnLeft(),
                'R' => $this->direction->turnRight(),
                default => throw new Exception(),
            };

            foreach ($this->position->walk($this->direction, (int) $m[2]) as $point) {
                $key = $point->getKey();

                if (isset($path[$key])) {
                    return $point->calcManhattanDistanceTo(new Point2D(0, 0));
                }

                $path[$key] = 1;
            }
        }

        return 0;
    }
}
