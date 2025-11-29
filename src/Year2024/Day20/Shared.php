<?php

declare(strict_types=1);

namespace AOC\Year2024\Day20;

use AOC\Util\Position2D;
use Generator;

use function array_flip;

trait Shared
{
    protected string $startKey;

    protected string $endKey;

    /** @var array<string, string> */
    protected array $walls;

    /** @var array<string, string> */
    protected array $track;

    /** @var array<int, string> */
    protected array $trackKeys;

    /** @var array<string, int> */
    protected array $distances;

    /**
     * @return void
     */
    protected function calcDistances(): void
    {
        $this->distances = [$this->startKey => 0];
        $currentKey = $this->startKey;

        $distance = 0;
        while ($currentKey !== $this->endKey) {
            foreach (Position2D::fromKey($currentKey)->getOrthogonalNeighborKeys() as $neighborKey) {
                if (isset($this->distances[$neighborKey])) {
                    continue;
                }

                if (!isset($this->track[$neighborKey])) {
                    continue;
                }

                $this->distances[$neighborKey] = ++$distance;
                $currentKey = $neighborKey;
                continue 2;
            }
        }

        $this->trackKeys = array_flip($this->distances);
    }

    /**
     * @param Generator $input
     * @param int $height
     * @param int $width
     */
    protected function init(Generator $input, int $height, int $width): void
    {
        Position2D::invertY();

        $this->walls = [];
        $this->track = [];

        $this->startKey = '';
        $this->endKey = '';

        foreach ($input as $y => $line) {
            if ($y === 0) {
                continue;
            }

            if ($y === $height - 1) {
                continue;
            }

            foreach (str_split((string) $line) as $x => $char) {
                if ($x === 0) {
                    continue;
                }

                if ($x === $width - 1) {
                    continue;
                }

                $key = Position2D::key($x, $y);

                if ($char === '#') {
                    $this->walls[$key] = '#';
                    continue;
                }

                if ($char === 'S') {
                    $this->startKey = $key;
                } elseif ($char === 'E') {
                    $this->endKey = $key;
                }

                $this->track[$key] = '.';
            }
        }

        $this->calcDistances();
    }
}
