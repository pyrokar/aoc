<?php

declare(strict_types=1);

namespace AOC\Year2023\Day16;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

trait Shared
{
    protected int $width = 0;
    protected int $height = 0;

    /**
     * @var array<string, array<string, int>>
     */
    protected array $beams = [];

    /**
     * @var array<string, string>
     */
    protected array $mirrors = [];

    /**
     * @var array<string, string>
     */
    protected array $splitters = [];


    /**
     * @var array<string, int>
     */
    protected array $energized = [];

    /**
     * @var array<string, array<string, CompassDirection>>
     */
    protected static array $mirrorDirection = [
        '/' => [
            CompassDirection::North->value => CompassDirection::East,
            CompassDirection::East->value => CompassDirection::North,
            CompassDirection::South->value => CompassDirection::West,
            CompassDirection::West->value => CompassDirection::South,
        ],
        '\\' => [
            CompassDirection::North->value => CompassDirection::West,
            CompassDirection::East->value => CompassDirection::South,
            CompassDirection::South->value => CompassDirection::East,
            CompassDirection::West->value => CompassDirection::North,
        ],
    ];

    /**
     * @param Generator<int, string> $input
     *
     * @return void
     */
    public function init(Generator $input): void
    {
        Position2D::invertY();

        $this->width = 0;
        $this->height = 0;
        $this->mirrors = [];
        $this->splitters = [];
        $this->beams = [];
        $this->energized = [];

        foreach ($input as $y => $line) {
            $this->height++;
            $this->width = strlen($line);

            foreach (str_split($line) as $x => $char) {
                if (in_array($char, ['/', '\\'], true)) {
                    $this->mirrors[Position2D::key($x, $y)] = $char;
                } elseif (in_array($char, ['|', '-'], true)) {
                    $this->splitters[Position2D::key($x, $y)] = $char;
                }
            }
        }
    }

    protected function sendBeam(Position2D $pos, CompassDirection $direction): void
    {
        while (true) {
            if ($pos->x < 0 || $pos->x >= $this->width || $pos->y < 0 || $pos->y >= $this->height) {
                // out of bounds
                return;
            }

            $key = $pos->getKey();
            $mirror = $this->mirrors[$key] ?? null;

            if (!$mirror && isset($this->beams[$key][$direction->value])) {
                // beam already on this position with same direction
                return;
            }

            $this->energized[$key] = 1;
            $this->beams[$key][$direction->value] = 1;

            if ($mirror) {
                $direction = self::$mirrorDirection[$mirror][$direction->value];
                $pos->move($direction, 1);
                continue;
            }

            $splitter = $this->splitters[$key] ?? null;

            if ($splitter) {
                if ($splitter === '-' && in_array($direction, [CompassDirection::North, CompassDirection::South], true)) {
                    $this->sendBeam($pos->getPositionForDirection(CompassDirection::West), CompassDirection::West);
                    $this->sendBeam($pos->getPositionForDirection(CompassDirection::East), CompassDirection::East);
                    return;
                }

                if ($splitter === '|' && in_array($direction, [CompassDirection::East, CompassDirection::West], true)) {
                    $this->sendBeam($pos->getPositionForDirection(CompassDirection::North), CompassDirection::North);
                    $this->sendBeam($pos->getPositionForDirection(CompassDirection::South), CompassDirection::South);
                    return;
                }
            }

            $pos->move($direction, 1);
        }
    }
}
