<?php

declare(strict_types=1);

namespace AOC\Year2023\Day22;

use AOC\Util\Direction3D;
use AOC\Util\Position3D;
use Generator;

/**
 * @phpstan-type BrickId string
 * @phpstan-type Brick list<Position3D>
 * @phpstan-type ListOfBrickIds array<BrickId, 1>
 */
trait Shared
{
    /** @var array<BrickId, Brick> */
    protected array $bricks;

    /** @var array<BrickId, ListOfBrickIds> */
    protected array $brickIsSupportedBy;

    /** @var array<BrickId, ListOfBrickIds> */
    protected array $brickSupports;

    /**
     * @param Generator<int, string> $input
     *
     * @return void
     */
    public function letThemFall(Generator $input): void
    {
        $this->bricks = [];

        foreach ($input as $brickId => $line) {
            [$from, $to] = array_map(
                static fn(string $coordinates) => Position3D::fromKey($coordinates, ','),
                explode('~', $line),
            );

            $dir = match (true) {
                $from->x > $to->x => Direction3D::Left,
                $from->y < $to->y => Direction3D::Forward,
                $from->y > $to->y => Direction3D::Backward,
                $from->z < $to->z => Direction3D::Up,
                $from->z > $to->z => Direction3D::Down,
                default => Direction3D::Right,
            };

            $i = clone $from;

            $brickCubes = [];

            if (!$from->isEqualTo($to)) {
                while (!$i->isEqualTo($to)) {
                    $brickCubes[] = clone $i;
                    $i->move($dir);
                }
            }
            $brickCubes[] = $to;

            $this->bricks[str_pad((string) $from->z, 3, '0', STR_PAD_LEFT) . '_' . $brickId] = $brickCubes;
        }

        // the key starts with the z coordinate, so this sorts the bricks by the z coordinate
        ksort($this->bricks);

        $cubesAtRest = [];

        $this->brickSupports = [];
        $this->brickIsSupportedBy = [];

        // gravity
        foreach ($this->bricks as $brickId => $brick) {
            $canFall = true;

            // fall
            while ($canFall) {
                /** @var Position3D $cube */
                foreach ($brick as $cube) {
                    $positionBelow = $cube->getPositionForDirection(Direction3D::Down);
                    if (isset($cubesAtRest[$positionBelow->getKey()])) {
                        $canFall = false;

                        $brickIdBelow = $positionBelow->getKey();

                        $this->brickSupports[$cubesAtRest[$brickIdBelow]][$brickId] = 1;
                        $this->brickIsSupportedBy[$brickId][$cubesAtRest[$brickIdBelow]] = 1;

                    } elseif ($cube->z === 1) {
                        $canFall = false;
                    }
                }

                if ($canFall) {
                    foreach ($brick as $cube) {
                        $cube->move(Direction3D::Down);
                    }
                }
            }

            // rest brick
            foreach ($brick as $cube) {
                $cubesAtRest[$cube->getKey()] = $brickId;
            }
        }
    }

    /**
     * @return ListOfBrickIds
     */
    public function getDisintegratedBricks(): array
    {
        $disintegratedBricks = [];

        foreach (array_keys($this->bricks) as $brickId) {
            if (!isset($this->brickSupports[$brickId])) {
                // brick does not support any other brick
                $disintegratedBricks[$brickId] = 1;
                continue;
            }

            $canDisintegrate = true;
            foreach (array_keys($this->brickSupports[$brickId]) as $supportedBrickId) {
                if (count($this->brickIsSupportedBy[$supportedBrickId]) === 1) {
                    // supported brick is only supportet by this brick => cannot disintegrate
                    $canDisintegrate = false;
                    break;
                }
            }

            if ($canDisintegrate) {
                $disintegratedBricks[$brickId] = 1;
            }
        }
        return $disintegratedBricks;
    }
}
