<?php

declare(strict_types=1);

namespace AOC\Year2024\Day15;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;
use Safe\Exceptions\PcreException;

use function str_split;
use function str_starts_with;
use function Safe\preg_match;

/**
 * @phpstan-import-type Move from Shared
 */
final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        Position2D::invertY();

        $this->walls = [];
        $this->boxes = [];

        foreach ($input as $y => $line) {
            if (str_starts_with($line, '#')) {
                foreach (str_split($line) as $x => $char) {
                    $key = Position2D::key($x, $y);
                    switch ($char) {
                        case '#':
                            $this->walls[$key] = '#';
                            break;
                        case 'O':
                            $this->boxes[$key] = 'O';
                            break;
                        case '@':
                            $this->robot = new Position2D($x, $y);
                            break;
                    }
                }

                continue;
            }

            if (preg_match('/^[<>^v]+$/', $line)) {
                /** @var list<Move> $movements */
                $movements = str_split($line);
                $this->moveRobot($movements);
            }
        }

        return $this->calcSumGPS();
    }

    /**
     * @param list<Move> $movements
     *
     * @return void
     */
    protected function moveRobot(array $movements): void
    {
        foreach ($movements as $movement) {
            $direction = match ($movement) {
                '<' => CompassDirection::West,
                '>' => CompassDirection::East,
                '^' => CompassDirection::North,
                'v' => CompassDirection::South,
            };

            $boxesToPush = [];
            $canMove = false;
            $nextPos = $this->robot->getPositionForDirection($direction);
            $nextPosKey = $nextPos->getKey();

            while (!isset($this->walls[$nextPosKey])) {
                if (isset($this->boxes[$nextPosKey])) {
                    $boxesToPush[$nextPosKey] = $nextPosKey;
                } elseif (!isset($this->walls[$nextPosKey])) {
                    $canMove = true;
                    break;
                }

                $nextPos = $nextPos->getPositionForDirection($direction);
                $nextPosKey = $nextPos->getKey();
            }

            if (!$canMove) {
                continue;
            }

            if (!empty($boxesToPush)) {
                $firstBoxKey = \AOC\Util\Safe\array_shift($boxesToPush);
                unset($this->boxes[$firstBoxKey]);
                $this->boxes[$nextPosKey] = 'O';
            }

            $this->robot->move($direction, 1);
        }
    }

}
