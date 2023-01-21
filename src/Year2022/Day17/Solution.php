<?php

namespace AOC\Year2022\Day17;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

trait Solution
{
    protected static array $rockShapes;
    protected array $ground;
    protected int $height;

    protected static function initRockShapes(): void
    {
        self::$rockShapes = [
            new RockShape([
                new Position2D(0, 0),
                new Position2D(1, 0),
                new Position2D(2, 0),
                new Position2D(3, 0),
            ], 4, 1),
            new RockShape([
                new Position2D(1, 0),
                new Position2D(0, 1),
                new Position2D(2, 1),
                new Position2D(1, 2),
            ], 3, 3),
            new RockShape([
                new Position2D(2, 0),
                new Position2D(2, 1),
                new Position2D(0, 2),
                new Position2D(1, 2),
                new Position2D(2, 2),
            ], 3, 3),
            new RockShape([
                new Position2D(0, 0),
                new Position2D(0, 1),
                new Position2D(0, 2),
                new Position2D(0, 3),
            ], 1, 4),
            new RockShape([
                new Position2D(0, 0),
                new Position2D(1, 0),
                new Position2D(0, 1),
                new Position2D(1, 1),
            ], 2, 2),
        ];
    }

    protected function print(RockShape $rock, Position2D $rockPosition): void
    {
        $r = $rock->getPositionKeys($rockPosition);

        $maxY = max([$this->height, $rockPosition->y]);
        for ($y = $maxY; $y >= 0; $y--) {
            for ($x = 0; $x < 7; $x++) {
                $key = Position2D::key($x, $y);
                if (isset($this->ground[$key])) {
                    echo '#';
                } elseif (isset($r[$key])) {
                    echo '@';
                } else {
                    echo '.';
                }
            }

            echo PHP_EOL;
        }

        echo PHP_EOL;
    }

    protected function getNextRock(int $i): RockShape
    {
        return self::$rockShapes[$i % 5];
    }

    protected function hasColision(RockShape $rock, Position2D $rockPosition): bool
    {
        foreach ($rock->getPositionKeys($rockPosition) as $r => $j) {
            if (isset($this->ground[$r])) {
                return true;
            }
        }

        return false;
    }

    private function getHeight(Generator $input, int $rounds): int
    {
        self::initRockShapes();

        $jetPattern = str_split($input->current());
        $jetPatternLength = count($jetPattern);

        $this->height = 0;
        $this->ground = array_flip([
            Position2D::key(0, -1),
            Position2D::key(1, -1),
            Position2D::key(2, -1),
            Position2D::key(3, -1),
            Position2D::key(4, -1),
            Position2D::key(5, -1),
            Position2D::key(6, -1),
        ]);
        $jetPointer = 0;

        for ($i = 0; $i < $rounds; $i++) {
            $rock = $this->getNextRock($i);
            $rockPosition = new Position2D(2, $this->height + 2 + $rock->height);

            // echo 'Start' . PHP_EOL;
            //$this->print($rock, $rockPosition);

            $rest = false;

            while (!$rest) {
                $jet = $jetPattern[$jetPointer];
                $jetPointer = ($jetPointer + 1) % $jetPatternLength;

                if ($jet === '<' && $rockPosition->x > 0 && !$this->hasColision($rock, $rockPosition->getPositionForDirection(CompassDirection::West))) {
                    $rockPosition->move(CompassDirection::West, 1);
                } elseif ($jet === '>' && $rockPosition->x + $rock->width < 7 && !$this->hasColision($rock, $rockPosition->getPositionForDirection(CompassDirection::East))) {
                    $rockPosition->move(CompassDirection::East, 1);
                }

                // Falling
                $newPosition = $rockPosition->getPositionForDirection(CompassDirection::South);

                if ($this->hasColision($rock, $newPosition)) {
                    foreach ($rock->getPositionKeys($rockPosition) as $r => $j) {
                        $this->ground[$r] = 1;
                    }
                    $rest = true;

                    if ($rockPosition->y >= $this->height) {
                        $this->height = $rockPosition->y + 1;
                    }
                } else {
                    $rockPosition = $newPosition;
                }
            }
        }

        echo 'Height: ' . $this->height . PHP_EOL;
        echo 'CountGround: ' . count($this->ground) . PHP_EOL;

        return $this->height;
    }
}
