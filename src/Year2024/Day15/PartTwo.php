<?php

declare(strict_types=1);

namespace AOC\Year2024\Day15;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;
use Safe\Exceptions\PcreException;
use SplStack;

use function Safe\preg_match;
use function str_split;

/**
 * @phpstan-import-type Move from Shared
 */
final class PartTwo
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
                    $key = Position2D::key(2 * $x, $y);
                    $nkey = Position2D::key(2 * $x + 1, $y);

                    switch ($char) {
                        case '#':
                            $this->walls[$key] = '#';
                            $this->walls[$nkey] = '#';
                            break;
                        case 'O':
                            $this->boxes[$key] = '[';
                            $this->boxes[$nkey] = ']';
                            break;
                        case '@':
                            $this->robot = new Position2D(2 * $x, $y);
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
    private function moveRobot(array $movements): void
    {
        foreach ($movements as $movement) {
            $direction = match ($movement) {
                '<' => CompassDirection::West,
                '>' => CompassDirection::East,
                '^' => CompassDirection::North,
                'v' => CompassDirection::South,
            };

            $canMove = false;
            $currentPos = $this->robot->getPositionForDirection($direction);
            $currentPosKey = $currentPos->getKey();

            $newBoxes = [];

            if (in_array($movement, ['<', '>'], true)) {
                while (!isset($this->walls[$currentPosKey])) {
                    if (isset($this->boxes[$currentPosKey])) {
                        $newBoxes[$currentPos->getPositionForDirection($direction)->getKey()] = $this->boxes[$currentPosKey];
                    } elseif (!isset($this->walls[$currentPosKey])) {
                        $canMove = true;
                        break;
                    }

                    $currentPos = $currentPos->getPositionForDirection($direction);
                    $currentPosKey = $currentPos->getKey();
                }

                if (!$canMove) {
                    continue;
                }

                foreach ($newBoxes as $newKey => $newBox) {
                    $this->boxes[$newKey] = $newBox;
                }

                $this->robot->move($direction, 1);
                unset($this->boxes[$this->robot->getKey()]);
            } else {
                if (isset($this->walls[$currentPosKey])) {
                    continue;
                }

                if (!isset($this->boxes[$currentPosKey])) {
                    $this->robot->move($direction, 1);
                    continue;
                }

                $oldBoxeKeys = [];
                $positionStack = new SplStack();
                $positionStack->push($currentPos);

                while (!$positionStack->isEmpty()) {
                    $currentPos = $positionStack->pop();
                    $currentPosKey = $currentPos->getKey();

                    $oldPositions = [
                        $currentPos,
                        $this->boxes[$currentPosKey] === '['
                            ? $currentPos->getPositionForDirection(CompassDirection::East)
                            : $currentPos->getPositionForDirection(CompassDirection::West),
                    ];

                    foreach ($oldPositions as $oldPosition) {
                        $newPosition = $oldPosition->getPositionForDirection($direction);
                        $newPosKey = $newPosition->getKey();

                        if (isset($this->walls[$newPosKey])) {
                            continue 3;
                        }

                        $newBoxes[$newPosition->getKey()] = $this->boxes[$oldPosition->getKey()];
                        $oldBoxeKeys[] = $oldPosition->getKey();

                        if (isset($this->boxes[$newPosKey])) {
                            $positionStack->push($newPosition);
                        }
                    }
                }

                foreach ($oldBoxeKeys as $oldBoxeKey) {
                    unset($this->boxes[$oldBoxeKey]);
                }

                foreach ($newBoxes as $newKey => $newBox) {
                    $this->boxes[$newKey] = $newBox;
                }

                $this->robot->move($direction, 1);

            }
        }
    }
}
